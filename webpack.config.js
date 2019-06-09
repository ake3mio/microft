const path = require('path');

module.exports = {
    entry: './src/index.js',
    output: {
        path: path.join(__dirname, 'website/wp-content/themes/microft'),
        filename: 'main.bundle.js'
    }
};
