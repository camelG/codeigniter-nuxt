const pkg = require("./package");

module.exports = {
  head: {
    title: pkg.name,
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: pkg.description }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
  },
  loading: { color: "#fff" },
  css: [],
  plugins: [],
  modules: ["@nuxtjs/axios", "bootstrap-vue/nuxt"],
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
  },
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  },
  bootstrapVue: {
    icons: false
  }
};
