<template>
    <div id="report">

        <a href="#" class="float-right" data-toggle="modal"
                :data-target="'#'+modalId">
            Report
        </a>

        <div :id="modalId" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        ><span
                                aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <form-wizard @on-complete="onComplete"
                                     color="#171738"
                                     error-color="#a94442" title="Report a post"
                                     subtitle="Follow the steps to report a post.">
                            <tab-content title="Report Information"
                                         icon="fa fa-user" :before-change="validateFirstTab">
                                <vue-form-generator :model="model"
                                                    :schema="firstTabSchema"
                                                    :options="formOptions"
                                                    ref="firstTabForm">

                                </vue-form-generator>
                            </tab-content>
                            <tab-content title="Report Comment"
                                         icon="fa fa-comment" :before-change="validateSecondTab">
                                <vue-form-generator :model="model"
                                                    :schema="secondTabSchema"
                                                    :options="formOptions"
                                                    ref="secondTabForm"
                                >
                                </vue-form-generator>
                                <div class="alert alert-danger error" v-show="hasErrors">
                                    <li v-for="error in errors">{{ error }}</li>
                                </div>
                            </tab-content>
                        </form-wizard>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import VueFormWizard from 'vue-form-wizard';
    import 'vue-form-wizard/dist/vue-form-wizard.min.css';
    import VueFormGenerator from "vue-form-generator";
    import "vue-form-generator/dist/vfg.css";

    Vue.use(VueFormWizard);
    Vue.use(VueFormGenerator);

    export default {
        props: ['id'],
        data() {
            return {
                errors: [],
                hasErrors:false,
                model: {
                    category: '',
                    reportComment: ''
                },
                formOptions: {
                    validationErrorClass: "has-error",
                    validationSuccessClass: "has-success",
                    validateAfterChanged: true
                },
                firstTabSchema: {
                    fields: [{
                        type: "radios",
                        label: "Please select the most relevant category",
                        model: "category",
                        required: true,
                        validator: VueFormGenerator.validators.string,
                        values: ['Hateful Content', 'Harassment and Cyberbullying', 'Spam or misleading', 'Harmful or dangerous content'],
                    },
                    ]
                },
                secondTabSchema: {
                    fields: [
                        {
                            type: "textArea",
                            label: "Please provide additional information",
                            required: true,
                            model: "reportComment",
                            rows: 6,
                            validator: VueFormGenerator.validators.string
                        },
                    ]
                }
            }
        },
        computed: {
            modalId() {
                return 'reportPostModal'+this.id;
            },
            storeFormUrl() {
                return '../posts/'+this.id+'/report';
            }
        },
        methods: {
            clearErrors() {
                this.errors = [];
                this.hasErrors = false;
            },
            onComplete: function () {
                this.clearErrors();
                axios.post(this.storeFormUrl, {
                    category: this.model.category,
                    description: this.model.reportComment,
                })
                    .then(function (response) {

                            if (!response.data.error) {
                                this.hasErrors = false;
                                location.href = '/';
                            }
                            for (var i = 0; i < response.data.message.length; i++) {
                                this.errors.push(response.data.message[i]);
                            }

                            this.hasErrors = true;

                        }.bind(this)
                    )
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            validateFirstTab: function () {
                return this.$refs.firstTabForm.validate();
            },
            validateSecondTab: function () {
                return this.$refs.secondTabForm.validate();
            }
        }
    }
</script>