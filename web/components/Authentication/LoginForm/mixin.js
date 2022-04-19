export default {
    data() {
        return {
            form: {
                email: null,
                password: null,
            },
            rules: {
                name: 'required|type:email|max:255',
                password: 'required|min:8',
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
