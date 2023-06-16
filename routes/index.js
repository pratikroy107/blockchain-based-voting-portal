const express = require('express')
const router = express.Router()
const needle = require('needle')
const apicache = require('apicache')

//vars
const API_KEY = process.env.API_KEY

//init cache
let cache = apicache.middleware

//OTP will last for 2 minutes then invalid
router.get('/', cache('2 minutes'), async (req, res) => {
    try {
        console.log(req.query.s)
        if(req.query.s ==undefined){
        const apiRes = await needle('get', `https://2factor.in/API/V1/${API_KEY}/SMS/${req.query.q}/AUTOGEN/OTP1`)
        const data = apiRes.body

        if(process.env.NODE_ENV !== 'production') {
            console.log(`request : ${data}`)
        }
        //console.log(":)success")
        res.status(200).json(data)
    }
    else{
        const apiRes = await needle('get', `https://2factor.in/API/V1/${API_KEY}/SMS/VERIFY/${req.query.s}/${req.query.o}`)
        const data = apiRes.body
        if(process.env.NODE_ENV !== 'production') {
            console.log(`request : ${data}`)
        }
        //console.log(":)success")
        res.status(200).json(data)
    }
    }
    catch (error) {
        res.status(500).json({ error })
    }
})

module.exports = router