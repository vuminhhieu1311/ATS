export default {
    data() {
        return {
            form: {
                email: null,
                password: null,
            },
            rules: {
                email: 'required',
                password: 'required',
            },
        };
    },

    methods: {
        async submitForm() {
            await this.$auth.loginWith('laravelSanctum', {
                data: this.form,
            });
        },
        loginWithGoogle() {
            window.location.href = `${process.env.BACKEND_URL}/social/google/login`;
        },
        loginWithFacebook() {
            window.location.href = `${process.env.BACKEND_URL}/social/facebook/login`;
        },
    },
};
