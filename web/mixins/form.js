import _isEmpty from 'lodash/isEmpty';
import _mapValues from 'lodash/mapValues';

function collectServerError(errors) {
    return _mapValues(errors, '0');
}

function parseValue(value) {
    if (typeof value !== 'string') {
        return value;
    }

    if (value === 'true') {
        return true;
    }

    if (value === 'false') {
        return false;
    }

    if (/,/.test(value)) {
        return value.split(',');
    }

    const number = Number(value);
    if (!Number.isNaN(number)) {
        return number;
    }

    return value;
}

function handleError(error) {
    if (error === false) {
        return;
    }

    if (error.response) {
        if (error.response.status === 419) {
            this.$message.error(this.$t('Your session is expired'));
        } else if (error.response.status === 422) {
            this.serverErrors = collectServerError(error.response.data.errors);
        } else {
            this.$handleError(error);
        }
    } else {
        throw error;
    }
}

const customValidator = {
    validateRange(rule, value, callback) {
        if (_isEmpty(value)) {
            callback();
            return;
        }

        const { numberRange } = rule;
        const numberValue = Number(value);
        if (Number.isNaN(numberValue) || !/^\d+(\.?\d{1,2})?$/.test(value)) {
            callback('Value is not a number');
        }
        if (Number(numberRange[0]) > numberValue || numberValue > Number(numberRange[1])) {
            callback(`Value must between ${numberRange[0]} and ${numberRange[1]}`);
        }
        callback();
    },
};

export default {
    data: () => ({
        processing: false,
        serverErrors: {},
        rules: [],
    }),

    computed: {
        formRules() {
            return _mapValues(this.rules, (spec, fieldName) => {
                let field = fieldName;

                return spec.trim('|').split('|').map((rule) => {
                    const [main, ...options] = rule.split(';');

                    const [assert, is = true] = main.split(':');
                    const value = parseValue(is);

                    if (assert === 'name') {
                        field = value;
                        return null;
                    }

                    const extras = options.reduce((acc, opt) => {
                        const [extraField, extraFieldValue] = opt.split(':');

                        if (extraField === 'validator') {
                            const validateFunc = customValidator[extraFieldValue];

                            if (!validateFunc) {
                                return {
                                    ...acc,
                                    [extraField]: parseValue(extraFieldValue),
                                };
                            }
                            return {
                                ...acc,
                                validator: validateFunc,
                            };
                        }
                        return {
                            ...acc,
                            [extraField]: parseValue(extraFieldValue),
                        };
                    }, {});

                    return {
                        [assert]: value,
                        message: this.$t(`validation.${assert}`, { field, value, extras }),
                        ...extras,
                    };
                }).filter(Boolean);
            });
        },
    },

    methods: {
        async submit(form, send) {
            this.serverErrors = {};

            try {
                this.processing = true;

                if (form.model) {
                    await form.validate();
                }

                const response = await send(form.model);
                this.$emit('saved', response ? response.data : null);
            } catch (error) {
                handleError.call(this, error);
            } finally {
                this.processing = false;
            }
        },

        clearError(form) {
            if (form) {
                form.clearValidate();
            }
            this.serverErrors = {};
        },

        resetForm(form) {
            if (form) {
                form.resetFields();
            }
        },
        handleError(error) {
            if (error === false) {
                return;
            }

            if (error.response) {
                if (error.response.status === 419) {
                    this.$message.error(this.$t('Your session is expired'));
                } else if (error.response.status === 422) {
                    this.serverErrors = collectServerError(error.response.data.errors);
                } else {
                    this.$handleError(error);
                }
            } else {
                throw error;
            }
        },
    },
};
