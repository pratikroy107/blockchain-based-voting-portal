// SPDX-License-Identifier: GPL-3.0

pragma solidity ^0.8.0;

import "contracts/AToken.sol";
contract Voting {

    struct State
    {
        string name;
        uint totalvoters;
        uint votedv;
        uint votingpercentage;
    }

    struct Candidate {
        string name;
        string party;
        bool registered;
        address candidateAddress;
        uint256 votes;
    }

    struct Party{
        uint id;
        string name;
        uint totalvote;
    }

    struct Voter {
        string name;
        string voterno;
        string adharno;
        string contactno;
        bool registered;
        address voterAddress;
        bool voted;
        string state;
    }

    enum PHASE {
        reg,
        regdone,
        voting,
        votingdone
    }

    uint256 count1 = 1; //candidate count
    uint256 count2 = 1; //voter count
    uint256 count3 = 1; //winners count
    uint256 count4 = 1; //Party count
    uint256 count5 = 1; //State count

    string[]  win;

    string public eventName;
    uint256 public totalVote;
    address public admin;
    string[] public winnerparty;
    bool votingStarted;

    event success(string msg);
    Candidate[] public candidateList;
    State[] public statesList;

    Voter[] public voters;
    Party[] public teams;


    mapping(uint256 => address) public candidates2;
    mapping(string => uint) public teams2;
    mapping(string => uint) public states;


    mapping(address => uint256) public candidates1;
    mapping(uint256 => address) public winnerAddress;
    mapping(address => uint256) public voterList;
    mapping(uint256 => Candidate) public winner;
    uint256 private frequenceOfMax = 0;

    PHASE public state;
    ElectionToken token;

    constructor(string memory _eventName) {
        token=ElectionToken(0xa4A147ECC1D1299D7F07Da113Ae14D535fF7cE34);
        require(token.admin()==msg.sender,"Admin should be same");
        require(token.balanceOf(msg.sender)>=5000000000,"Not Enough Tokens to deploy");
        admin = msg.sender;
        state = PHASE.reg;
        eventName = _eventName;
        totalVote = 0;
        votingStarted = false;
    }

    modifier onlyAdmin() {
        require(msg.sender == admin, "Only Admin is allowed to do this");
        _;
    }

    modifier notAdmin() {
        require(msg.sender!=admin, "Admin is not allowed to do this");
        _;
    }

    modifier validState(PHASE x) {
        require(state == x);
        _;
    }

    function changeState(PHASE p) private onlyAdmin {
        require(p > state, "This phase changing is not synchronized");
        state = p;
    }
function candidateDisplay() public view returns(Candidate[] memory) 
{
        return candidateList;
}

function voterDisplay() public view returns(Voter[] memory) 
{
        return voters;
}

 function mint(address to,uint amt) public onlyAdmin 
    {
        token.mint(to,amt);
    }

 function checkVoter(string memory cn) public validState(PHASE.voting) view returns(bool)
    {
        if(keccak256(abi.encodePacked(voters[voterList[msg.sender]].contactno)) == keccak256(abi.encodePacked(cn)))
        {
            return true;
        }
        return false;
    }

function partyDisplay() public view returns(Party[] memory,uint a) 
{
        return (teams,totalVote);
}

    function registerCandidate(
        string memory _name,
        string memory _party
    ) public notAdmin validState(PHASE.reg) {
        require(token.balanceOf(msg.sender)>0,"Not Enough Tokens to register");
        address _candidateAddress=msg.sender;
        require(_candidateAddress != admin, "Owner can not participate!!");
        require(
            candidates1[_candidateAddress] == 0,
            "Candidate already registered"
        );
        Candidate memory candidate = Candidate({
            name: _name,
            party: _party,
            registered: true,
            votes: 0,
            candidateAddress: _candidateAddress
        });

        if(teams2[_party]<1){
        Party memory team = Party({
            id: count4,
            name: _party,
            totalvote: 0
        });
        teams2[_party]=count4;
        count4++;
        if (teams.length == 0) {
            teams.push();
        }
        teams.push(team);
        }

        if (candidateList.length == 0) {
            candidateList.push();
        }
        candidates1[_candidateAddress] = candidateList.length;
        candidates2[count1] = _candidateAddress;
        count1++;
        candidateList.push(candidate);
        emit success("Candidate registered!!");
    }

    function registerVoter( string memory _name,string memory _votern,string memory _adharno,string memory _cn,string memory _state)
        public notAdmin
        validState(PHASE.reg)
    {
         address _voterAddress=msg.sender;
        require(_voterAddress != admin, "Owner can not vote!!");
        require(
            voterList[_voterAddress] == 0,
            "Voter already registered!!"
        );

        Voter memory voter = Voter({
            name:_name,
            voterno:_votern,
            adharno:_adharno,
            contactno:_cn,
            registered: true,
            voterAddress: _voterAddress,
            voted: false,
            state:_state
        });

        if(states[_state]<1){
        State memory s = State({
            name:_state,
            totalvoters: 1,
            votedv:0,
            votingpercentage: 0
        });
        states[_state]=count5;
        count5++;
        if (statesList.length == 0) {
            statesList.push();
        }
        statesList.push(s);
        }
        else{
            statesList[states[_state]].totalvoters++;
        }

          if (voters.length == 0) {
            voters.push();
        }
        voters.push(voter);
        voterList[_voterAddress] = count2;
        count2++;
        emit success("Voter registered!!");
    }

     function reviewCandidate(address _addressC,bool T) public onlyAdmin validState(PHASE.reg) {    
        candidateList[candidates1[_addressC]].registered=T;
     }

     function reviewVoter(address _addressV,bool T) public onlyAdmin validState(PHASE.reg) {
            
        voters[voterList[_addressV]].registered=T;

     }

   
    function registrationCompleted() public onlyAdmin validState(PHASE.reg) {
        changeState(PHASE.regdone);
    }

    function startVoting() public onlyAdmin validState(PHASE.regdone) {
        votingStarted = true;
        changeState(PHASE.voting);

        emit success("Voting Started!!");
    }

    function stopVoting() public onlyAdmin validState(PHASE.voting) {
        changeState(PHASE.votingdone);
        votingStarted = false;
        getWinner();
        stateWiseVotingPercentageCalc();
        emit success("Voting stoped!!");
    }

    function stateWiseVotingPercentageCalc() public validState(PHASE.votingdone)
    {
        for(uint i=1;i<count5;i++)
        {
           statesList[i].votingpercentage=(statesList[i].votedv/statesList[i].totalvoters)*100;
        }
    }

    function stateWiseVotingPercentage() public onlyAdmin validState(PHASE.votingdone) view returns(State[] memory) 
    {
       return statesList;
    }

    function putVote(uint256 id) public notAdmin validState(PHASE.voting) {
        require(
            voters[voterList[msg.sender]].registered == true,
            "Voter not registered!!"
        );
        require(voters[voterList[msg.sender]].voted == false, "Already voted!!");
        require(
            candidateList[id].registered == true,
            "Candidate not registered"
        );

        candidateList[id].votes++;
        voters[voterList[msg.sender]].voted = true;
        statesList[states[voters[voterList[msg.sender]].state]].votedv++;

        totalVote++;

        teams[teams2[candidateList[id].party]].totalvote++;

        uint256 max = 0;

        for (uint256 i = candidateList.length - 1; i > 0; i--) {
            if (candidateList[i].votes > max) {
                max = candidateList[i].votes;
                frequenceOfMax = 1;
            } else if (candidateList[i].votes == max) {
                frequenceOfMax++;
            }
        }
        uint256 f = 1;
        for (uint256 i = 0; i < candidateList.length; i++) {
            if (
                candidateList[i].votes == max &&
                winner[f - 1].candidateAddress !=
                candidateList[i].candidateAddress
            ) {
                winner[f] = candidateList[i];
                winnerAddress[f] = winner[f].candidateAddress;
                f++;
            }
        }
        emit success("Voted !!");
    }

    function getWinner()
        public
        validState(PHASE.votingdone)
    {
        Candidate[] memory ret;
        if (frequenceOfMax != 1) {
            ret = new Candidate[](frequenceOfMax + 1);
            for (uint256 i = 1; i < frequenceOfMax + 1; i++) {
                ret[i] = winner[i];
            }
        } else {
            ret = new Candidate[](frequenceOfMax);
            ret[0] = winner[1];
        }

        for(uint i=0;i<ret.length;i++)
        {
           win.push(ret[i].name);
        }
}

 function getWinnerNames()
        public view
        validState(PHASE.votingdone) returns(string[] memory)
    {
            return win;
    }

    function getAllCandidate()
        public
        view
        returns (Candidate[] memory list)
    {
        return candidateList;
    }

    function votingStatus() public view returns (bool) {
        return votingStarted;
    }

function votingStat() public view returns (string memory)
{
    if(state==PHASE.reg)
    {
        return "Registration is going on";
    }
    else if(state==PHASE.regdone)
    {
        return "Registration Done";
    }
    else if(state==PHASE.voting)
    {
        return "Voting is going on!!! DO VOTE";
    }
    return "Voting has ended";
}

}