<template>
    <div id="editor" class="border">
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <link
                    rel="stylesheet"
                    href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined"
                >
                <link
                    rel="stylesheet"
                    href="http://localhost:3000/template/template2.css"
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
                        <div class="resume_item resume_about">
                            <div class="title">
                                <p class="bold">About me</p>
                            </div>
                            <p>Hello</p>
                        </div>
                        <div class="resume_item resume_work">
                            <div class="title">
                                <p class="bold">
                                    Experience
                                </p>
                            </div>
                            <ul>
                                <li>
                                    <div class="date">
                                        13/12/2000 -
                                        13/11/2000
                                    </div>
                                    <div class="info">
                                        <p class="">
                                            PHP Dev.
                                        </p>
                                        <p>FPT</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="resume_item resume_education">
                            <div class="title">
                                <p class="bold">
                                    Education
                                </p>
                            </div>
                            <ul>
                                <li>
                                    <div class="date">
                                        13/12/2000 -
                                        13/11/2000
                                    </div>
                                    <div class="info">
                                        <p>BK</p>
                                        <p>
                                            IT
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="resume_item resume_education">
                            <div class="title">
                                <p class="bold">
                                    Certification
                                </p>
                            </div>
                            <ul>
                                <li>
                                    <div class="info">
                                        <p class="semi-bold">
                                            TOEIC 350
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </div>
</template>

<script>
    export default {
        name: 'CVTemplate1',
    };
</script>
