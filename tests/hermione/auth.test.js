
describe('auth',function () {
    it('открыть сайт', function () {
        return this.browser.url('http://geekbrains.dusty/')
            .waitForVisible('.blog-content')
    });

    it ('перейти на страницу авторизации', function() {
        return this.browser.click(".user-menu")
            .waitForVisible('.signin')
            .click(".signin")
            .waitForVisible('#login-form')
    });

    it ('ввод неверных данных и сообщение об ошибке', function() {
        return this.browser.setValue("#loginform-username", '1234')
            .setValue("#loginform-password", '12354')
            .click("[name='login-button']")
            .waitForVisible('.blog-content')
            .waitForVisible('.has-error')
    });

});