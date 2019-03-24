module.exports = {
    devServer: {
        proxy:'http://127.0.0.1:8000' //'http://10.103.1.200:8098'
    },
    chainWebpack: config => {
        const oneOfsMap = config.module.rule('scss').oneOfs.store
        oneOfsMap.forEach(item => {
            item
                .use('sass-resources-loader')
                .loader('sass-resources-loader')
                .options({
                    resources: ['./src/style/vars.scss']
                })
                .end()
        })
    }
}