<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailTemplate::truncate();

        MailTemplate::create([
            'name' => 'CV Receive Confirmation',
            'title' => '[ATS._HR] Notification of successful applying',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>Thanks for applying to ATS.
                Your application has been received and we will review it right away.<br><br>
                If your application seems like a good fit for the position we will contact you soon.<br><br>
                Best regards,<br><br><br><br><br><br>
                ATS - Human Resources Department<br><br>
                Website: https://ats.vn<br>Email: hr@ats.com<br><br>
                Address: 14, Keangnam Hanoi Landmark Tower, Plot E6, Me Tri, Nam Tu Liem, Hanoi, Vietnam<br>
                -----------------------------------------------------------------------------------------
                -------------------<br><br>** Please note: Do not reply to this email.
                This email is sent from an unattended mailbox. Replies will not be read.',
        ]);
        MailTemplate::create([
            'name' => 'Career - Interview Invitation to candidate',
            'title' => '[ATS._HR] Letter of invitation to interview',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>
                Thank you for your application for the position of [JOB_NAME] at ATS.<br>
                We would like to invite you to the interview as following:<br><br>
                Time: [INTERVIEW_START_TIME]. Please be present at our office 5 minutes before the scheduled interview.<br>
                Address: ATS. - Da Nang Office - 4F, FHome Building, 16 Ly Thuong Kiet Street, Hai Chau District, Da Nang.<br>
                If you are unable to attend at the specified time, please could you let me know as soon as possible
                via email or phone (in the signature line below) so that we can try to rearrange.<br><br>
                In case you are a software developer and your CV does not have the following information,
                please update it and send back to me before the interview date:<br>
                -    Working history : Listing out all the company you have worked in with the specific time<br>
                -    Project experiences: Listing out all the projects you have joined, including: Project name/
                Project description/ Team size/ Position/ Responsibility/ Technology (Programming language;
                Database; Unit test tool....)<br><br><br><br>Thank you so much!<br>---------------------------
                --------------------------<br>LIKE & FOLLOW us to know how we WORK, LEARN and HAVE FUN<br><br><br>
                Website: ATS. Recruitment<br>Facebook Fanpage: ATS Careers<br>LinkedIn: ATS<br>
                News: ATS News<br><br>[MY_SIGNATURE]',
        ]);
        MailTemplate::create([
            'name' => '(Covid-19) Hangout Interview Invitation Letter',
            'title' => '[ATS._HR] Letter of invitation to interview',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>
                Thank you for your application for the position of [JOB_NAME] at ATS.<br><br>
                Due to the spread of Covid-19 and its significant impact recently,
                ATS temporarily changes the interview method from offline to online (via Google Hangouts).
                <br><br>We would like to invite you to the interview as following:<br><br>
                Time: [INTERVIEW_START_TIME].<br>
                Method: Online via Hangouts<br>Hangout link: [HANGOUT_LINK]<br>
                Please prepare your device in a quiet place and have a good network signal and join link
                above 5 minutes before scheduled call. Our interviewer will call you at that time.<br><br>
                If you are unable to attend at the specified time, please could you let me know as soon as possible
                via email or phone (in the signature line below) so that we can try to rearrange.<br><br>
                Thank you so much!<br>-----------------------------------------------------<br>
                LIKE & FOLLOW us to know how we WORK, LEARN and HAVE FUN<br><br>
                Website: ATS. Recruitment<br>Facebook Fanpage: ATS Careers<br>LinkedIn: ATS<br>
                News: ATS News<br><br>[MY_SIGNATURE]',
        ]);
        Mailtemplate::create([
            'name' => 'Career - CV Reviewed; Failed',
            'title' => '[ATS._HR] Notification of CV Review results',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>We appreciate your interest in ATS.
                and the time you???ve invested in applying for the job in our company.<br><br>
                We wanted to let you know that although your resume and cover letter were very competitive,
                our hiring team reviewed your application and did not select it for further consideration.<br><br>
                We will, however, keep your resume on record and get in touch with you about future opportunities
                that may be a better fit for your skills and experience.<br><br>
                We wish you all the best in your job search and hope we will have the chance to consider you
                for another role in the future.<br><br>LIKE & FOLLOW us to know how we WORK, LEARN and HAVE FUN
                <br><br>Website: ATS Inc. Recruitment<br>Facebook Fanpage: ATS Careers<br>LinkedIn: ATS<br><br>
                Thank you & best regards,<br><br>[MY_SIGNATURE]',
        ]);
        MailTemplate::create([
            'name' => 'Career - Interviewed; Failed',
            'title' => '[ATS._HR] Thank you letter',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>
                Thank you very much for your attendance at our interview for the post of [JOB_NAME].
                We appreciate your interest in our company and the time you???ve invested in applying for our opening.
                <br><br>After careful consideration, we regret to inform you that you are not the right fit
                for this position at present.<br><br>Honestly, our team was impressed by your skills
                and accomplishments. We think you could be a good fit for other future openings and
                will reach out again if we find a good match.<br><br>We sincerely wish you success in your
                career path and your life.<br><br>Again, thank you for your time.<br><br><br>
                Best regards,<br><br>[MY_SIGNATURE]',
        ]);
        MailTemplate::create([
            'name' => 'Career - Reject offer response',
            'title' => '[ATS._HR] Thank you letter',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>Thank you very much for your attendance at our
                interview and your thorough consideration about our Job Offer for the position of [JOB_NAME].
                <br><br>We appreciate your interest in our company and we really regret that we don???t get chance
                to work with you at this time. However, we know that it was not an easy decision for you.<br><br>
                We sincerely wish you success in your career path and your life.
                We hope to keep contact with you and do look forward to further co-operation in the future.<br><br>Thank you,<br><br>[MY_SIGNATURE]',
        ]);
        MailTemplate::create([
            'name' => 'Career - Keep candidates for later',
            'title' => '[ATS._HR] Thank you letter',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>Thank you very much for your interest in ATS.
                and we are very impressed by your ability and experience shown in your CV.<br><br>
                Unfortunately, we do not have any available vacancies for this position now. ATS would like to
                keep your information in our database for further recruitment and hope you???ll keep us in mind.
                <br><br>Wish you every success and look forward to working with you soon.<br><br>
                Thank you & best regards,<br><br>[MY_SIGNATURE]',
        ]);
        MailTemplate::create([
            'name' => 'Career - Offer Letter [Vietnamese]',
            'title' => '[ATS._HR] Th?? m???i l??m vi???c_[CANDIDATE_NAME]_[TODAY_DATE]',
            'content' => 'Dear [CANDIDATE_NAME],<br><br>Thay m???t ATS, c???m ??n b???n ???? d??nh th???i gian
                quan t??m v?? ???ng tuy???n cho v??? tr?? [JOB_NAME] c???a C??ng ty.<br><br>
                Qua c??c bu???i ph???ng v???n, ATS tin r???ng b???n th???c s??? l?? nh??n t??? ph?? h???p m?? C??ng ty ??ang ki???m t??m;
                v?? v???y ATS tr??n tr???ng g???i t???i b???n th?? m???i l??m vi???c v???i c??c th??ng tin chi ti???t v??? l????ng, th?????ng
                v?? c??c ch??? ????? kh??c t???i file ????nh k??m d?????i ????y.<br><br>B???n l??u ?? gi??p m??nh t???t c??? nh???ng th??ng tin
                ???????c ????? c???p trong th?? m???i l??m vi???c n??y ?????u l?? b???o m???t; b???n vui l??ng kh??ng chia s??? d?????i b???t k??? h??nh
                th???c n??o khi ch??a ???????c s??? ?????ng ?? t??? ATS.<br><br>N???u c?? th???c m???c g?? th??m, b???n vui l??ng
                li??n h??? tr???c ti???p v???i m??nh qua email ho???c ??i???n tho???i nh??.<br><br>Hy v???ng b???n s??? tr??? th??nh
                m???t m???nh gh??p quan tr???ng ?????ng h??nh c??ng ATS ttrong s??? m???nh mang l???i nh???ng thay ?????i t??ch c???c cho
                to??n x?? h???i.<br><br>Mong s???m nh???n ???????c h???i ??m t??? b???n.<br>C???m ??n b???n,<br>[MY_SIGNATURE]',
        ]);
        MailTemplate::create([
            'name' => 'Career - Offer letter [Eng]',
            'title' => '[ATS._HR] Offer letter_[CANDIDATE_NAME]_[TODAY_DATE]',
            'content' => 'Dear Mr/Ms. [CANDIDATE_NAME],<br><br>Thank you very much for taking the time to apply
                for the job, as well as for your interest in ATS.<br><br>We have enjoyed talking to you
                during the recruitment process and we believe you are a good fit for us. Therefore, on behalf
                of ATS Inc., I would like to formally offer you the position of [JOB_NAME] at our Company.<br><br>
                Please find the offer letter attached to this email for more details about your salary,
                bonus and other benefits.<br><br><br>** Please note that all information mentioned in this job
                offer is confidential and known to you only. Please do not share this information in any form
                "without consent from ATS.<br><br>Should you have any questions or concerns, please dont ".
                hesitate to contact me directly through email or phone.<br>We hope you will become an important
                part of ATS in our mission to bring positive change to society.<br><br>We look forward to hearing
                from you soon.<br><br>Thank you and have a good day.<br><br>Sincerely,<br><br>[MY_SIGNATURE]',
        ]);
    }
}
