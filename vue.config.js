module.exports = {
  devServer: {
    proxy: {
      '/api': {
        target: 'http://localhost/backend',
        changeOrigin: true,
        pathRewrite: {
          '^/api': ''
        }
      }
    }
  }
}