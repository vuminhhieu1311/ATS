<template>
    <div>
        <el-collapse v-model="activeNames" @change="handleChange">
            <el-collapse-item title="Consistency" name="1">
                <el-rate
                    v-model="value"
                    :colors="colors"
                    :texts="[$t('poor'), $t('fair'), $t('good'), $t('very good'), $t('excellent')]"
                    show-text
                />
                <div>Consistent withindesign style, icons and texts, position of elements, etc.</div>
            </el-collapse-item>
            <el-collapse-item title="Feedback" name="2">
                <div> their operations by style updates and interactive effects;</div>
                <div>Visual feedback: reflect curres of the page.</div>
            </el-collapse-item>
            <el-collapse-item title="Efficiency" name="3">
                <div>Simplify the process: keep operating process simple and intuitive;</div>
                <div>Definitecan quickly understand and make decisions;</div>
                <div>Easy to identify: the interfaem from memorizing and recalling.</div>
            </el-collapse-item>
            <el-collapse-item title="Controllability" name="4">
                <div>Decision makindecisions for the users;</div>
                <div>Controlled consequences:ng or terminating current operation.</div>
            </el-collapse-item>
        </el-collapse>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        name: 'AssessmentForm',

        mixins: [mixin],
    };
</script>
