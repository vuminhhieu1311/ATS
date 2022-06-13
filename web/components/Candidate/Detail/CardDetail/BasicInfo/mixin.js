export default {
    props: {
        candidate: {
            type: Object,
            required: true,
        },
        submitForm: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            form: {
                name: this.$get(this.candidate, 'user.name', null),
                email: this.$get(this.candidate, 'user.email', null),
                phoneNumber: this.$get(this.candidate, 'user.phoneNumber', null),
                birthday: this.$get(this.candidate, 'user.birthday', null),
                gender: this.$get(this.candidate, 'user.gender', null),
                address: this.$get(this.candidate, 'user.address', null),
                description: this.$get(this.candidate, 'description', null),
            },
            rules: {
                name: 'required|type:string;whitespace:true|max:255',
                email: 'required;trigger:change|type:email',
                phoneNumber: 'name:phone number',
            },
        };
    },
};
