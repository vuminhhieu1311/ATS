<template>
    <div id="editor" class="border">
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Job Pro</title>
                <link
                    rel="stylesheet"
                    href="http://localhost:3000/templates/template1.css"
                >
                <link
                    rel="stylesheet"
                    href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined"
                >
            </head>
            <body>
                <div class="wrapper">
                    <div class="resume">
                        <div class="left">
                            <div class="img_holder">
                                <img src="">
                            </div>
                            <div class="contact_wrap pb">
                                <div class="title">Contact</div>
                                <div class="contact">
                                    <ul>
                                        <li>
                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <span class="material-icons-outlined">call</span>
                                                </div>
                                                <div class="text">
                                                    2312423432543
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <span class="material-icons-outlined">email</span>
                                                </div>
                                                <div class="text">
                                                    fdgdsfe@gmail.com
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="li_wrap">
                                                <div class="icon">
                                                    <span class="material-icons-outlined">location_on</span>
                                                </div>
                                                <div class="text">Ha Noi</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="skills_wrap pb">
                                <div class="title">Skills</div>
                                <div class="contact">
                                    <ul>
                                        <li>
                                            <div class="li_wrap">
                                                <div class="text">
                                                    English, Communication
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="skills_wrap pb">
                                <div class="title">Certifications</div>
                                <div class="contact">
                                    <ul>
                                        <li>
                                            <div class="li_wrap">
                                                <div class="text">
                                                    TOEIC 800
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="header">
                                <div class="name_role">
                                    <div class="name">Vu Minh Hiue</div>
                                    <div class="role">PHP Dev</div>
                                </div>
                                <div class="about">Hello</div>
                            </div>
                            <div class="right_inner">
                                <div class="exp">
                                    <div class="title">Experience</div>
                                    <div class="exp_wrap">
                                        <ul>
                                            <li>
                                                <div class="li_wrap">
                                                    <div class="date">
                                                        13/11/2000 - 13/`1/2000
                                                    </div>
                                                    <div class="info">
                                                        <p class="info_title">
                                                            PHP Dev
                                                        </p>
                                                        <p class="info_cont">
                                                            FPT
                                                        </p>
                                                        <p class="info_com">
                                                            Fulltime
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="education">
                                    <div class="title">Education</div>
                                    <div class="education_wrap">
                                        <ul>
                                            <li>
                                                <div class="li_wrap">
                                                    <div class="date">
                                                        13/11/2000 - 13/11/2000
                                                    </div>
                                                    <div class="info">
                                                        <p class="info_title">
                                                            IT
                                                        </p>
                                                        <p class="info_cont">
                                                            BK
                                                        </p>
                                                        <p class="info_com">
                                                            Bachelor - 4.0
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
