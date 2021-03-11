require("dotenv").config();
const pkg = require("./package");

module.exports = {
  ssr: false,
  head: {
    title: pkg.name,
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { hid: "description", name: "description", content: pkg.description }
    ],
    link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    script: [
      {
        src:
          "https://polyfill.io/v3/polyfill.min.js?features=default,es2015,Intl",
        crossorigin: "anonymous"
      }
    ]
  },
  loading: { color: "#fff" },
  css: [],
  plugins: [],
  modules: [
    "@nuxtjs/axios",
    "@nuxtjs/auth",
    "@nuxtjs/dotenv",
    "bootstrap-vue/nuxt"
  ],
  axios: {
    // See https://github.com/nuxt-community/axios-module#options
    baseURL: process.env.API_URL
  },
  build: {
    /*
     ** You can extend webpack config here
     */
    extend(config, ctx) {}
  },
  auth: {
    redirect: {
      login: "/login",
      logout: "/login",
      callback: "/",
      home: "/"
    },
    cookie: {
      prefix: "auth.",
      options: {
        path: "/",
        expires: 365
      }
    },
    strategies: {
      local: {
        endpoints: {
          login: {
            url: "/auth/login",
            method: "post",
            properryName: "token"
          },
          logout: {
            url: "/auth/logout",
            method: "post"
          },
          user: {
            url: "/auth/user",
            method: "get",
            propertyName: "user"
          }
        },
        tokenRequired: true,
        tokenName: "Authorizationx",
        tokenType: false, //Bearer
        sameSite: "None",
        Secure: true
      }
    }
    // plugins: ["~/plugins/auth-lang-redirect"]
  },
  bootstrapVue: {
    icons: false
  }
};
