const express = require('express')
const cors = require('cors')
const rateLimit = require('express-rate-limit')
require('dotenv').config()

const PORT = process.env.PORT || 5000

const app = express()

//rate limiting
const limiter = rateLimit ({
    //for stopping spam
    windowMs: 1 * 10 * 100, // 10 sec
    max: 20 // 1 requests in 1 minute
})
app.use(limiter)
app.set('trust proxy', 1)

//set static folder for use
app.use(express.static('VOTER'))

//routes
app.use('/api', require('./routes'))

//enable cors
app.use(cors())

app.listen(PORT, () => console.log(`Server running on port ${PORT}`))
