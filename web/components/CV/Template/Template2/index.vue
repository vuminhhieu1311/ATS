<template>
    <div ref="resume">
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <link
                    rel="stylesheet"
                    href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined"
                >
                <link
                    rel="stylesheet"
                    href="http://localhost:3000/templates/template2.css"
                >
            </head>
            <body>
                <div class="resume">
                    <div class="resume_left">
                        <div class="resume_profile">
                            <img src="">
                        </div>
                        <div class="resume_content">
                            <div class="resume_item resume_info">
                                <div class="title">
                                    <p class="bold">Hieu</p>
                                    <p class="regular">
                                        Dev
                                    </p>
                                </div>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <span class="material-icons-outlined">location_on</span>
                                        </div>
                                        <div class="data">
                                            Ha Noi
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="material-icons-outlined">call</span>
                                        </div>
                                        <div class="data">
                                            023432523543
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="material-icons-outlined">email</span>
                                        </div>
                                        <div class="data">
                                            gsertgh@gmail.com
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="resume_item resume_skills">
                                <div class="title">
                                    <p class="bold">
                                        Skills
                                    </p>
                                </div>
                                <ul>
                                    <li>
                                        <div class="skill_name">
                                            English
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="resume_item resume_social">
                                <div class="title">
                                    <p class="bold">Social</p>
                                </div>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <img src="~/assets/images/fb.png">
                                        </div>
                                        <div class="data">
                                            <p class="semi-bold">Facebook</p>
                                            <p>hieu</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="~/assets/images/linkedin.png">
                                        </div>
                                        <div class="data">
                                            <p class="semi-bold">Linkedin</p>
                                            <p>Hieu</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="resume_right">
                        <div v-for="(item, index) in outline" :key="index">
                            <component
                                :is="item"
                            />
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </div>
</template>

<script>
    import Description from './Description.vue';
    import Education from './Education.vue';
    import Experience from './Experience.vue';
    import Certification from './Certification.vue';

    export default {
        name: 'CVTemplate2',

        components: {
            Description,
            Education,
            Experience,
            Certification,
        },

        props: {
            outline: {
                type: Array,
                required: true,
            },
        },
    };
</script>
