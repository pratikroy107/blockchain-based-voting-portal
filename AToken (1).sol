//SPDX-License-Identifier: MIT
pragma solidity ^0.8.5;
import "https://github.com/OpenZeppelin/openzeppelin-contracts/blob/master/contracts/token/ERC20/ERC20.sol";
import "https://github.com/OpenZeppelin/openzeppelin-contracts/blob/master/contracts/access/Ownable.sol";


contract ElectionToken is ERC20{

    address public admin;

    constructor() ERC20('Election Token', 'ECT')
    {
        _mint(msg.sender,10000 * 10 ** 18);
        admin=msg.sender;
    }

    function mint(address to,uint amt) external
    {
        amt=amt * 10 ** 18;
        _mint(to,amt);
    }

      function burn(uint amt) external
    {
        _burn(msg.sender,amt);
    }
}