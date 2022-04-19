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
            this.$router.push({ path: '/' });
        },
    },
};
