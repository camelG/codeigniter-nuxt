export default ({ app }) => {
    var redirect = app.$auth.$storage.options.redirect;
    for (var key in redirect) {
      if (app.i18n.defaultLocale != app.i18n.locale) {
        redirect[key] = "/" + app.i18n.locale + redirect[key];
      }
    }
    app.$auth.$storage.options.redirect = redirect;
  };