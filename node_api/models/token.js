var mongoose     = require('mongoose');
var Schema       = mongoose.Schema;

var tokenSchema   = new Schema({
    user_name: String,
    token_id: String
   
});

module.exports = mongoose.model('Token', tokenSchema);