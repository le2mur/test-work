const path = require('path');

module.exports = {
    publicPath: '/frontend/dist/',
    devServer: {
        proxy: 'http://localhost:8000'
    },
};
