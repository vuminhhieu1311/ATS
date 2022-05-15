<template>
    <el-dialog
        :visible.sync="show"
        width="70%"
        @close="close"
    >
        <span slot="title">
            <h4 class="text-xl font-medium">{{ $t('schedule interview') }}</h4>
        </span>
        <el-form
            v-if="step"
            ref="form"
            :model="form"
            :rules="formRules"
            label-position="left"
        >
            <div class="bg-gray-50 p-8 pb-2 border">
                <p class="text-xl font-semibold mb-5">{{ $t('interview information') }}</p>
                <el-form-item prop="name" :error="serverErrors.name">
                    <el-input v-model="form.name" clearable :placeholder="$t('interview name')" />
                </el-form-item>
                <el-form-item>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-1">
                            <el-form-item prop="date" class="w-full">
                                <el-date-picker
                                    v-model="form.date"
                                    type="date"
                                    class="w-full"
                                    value-format="yyyy-MM-dd"
                                    :placeholder="$t('date')"
                                />
                            </el-form-item>
                        </div>
                        <div class="col-span-1">
                            <el-form-item prop="startTime" :error="serverErrors.startTime">
                                <el-time-picker
                                    v-model="form.startTime"
                                    format="HH:mm"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    :placeholder="$t('start time')"
                                />
                            </el-form-item>
                        </div>
                        <div class="col-span-1">
                            <el-form-item prop="endTime" :error="serverErrors.endTime">
                                <el-time-picker
                                    v-model="form.endTime"
                                    format="HH:mm"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    :placeholder="$t('end time')"
                                />
                            </el-form-item>
                        </div>
                    </div>
                </el-form-item>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <el-form-item prop="note" :error="serverErrors.note">
                            <el-input
                                v-model="form.note"
                                type="textarea"
                                :rows="7"
                                :placeholder="$t('note')"
                            />
                        </el-form-item>
                    </div>
                    <div class="col-span-1">
                        <el-form-item prop="staffs" class="w-full" :error="serverErrors.staffs">
                            <el-select
                                v-model="form.staffs"
                                multiple
                                class="w-full"
                                filterable
                                :placeholder="$t('interviewers')"
                            >
                                <el-option
                                    v-for="interview in staffs"
                                    :key="$get(interview, 'id')"
                                    :label="$get(interview, 'user.name')"
                                    :value="$get(interview, 'id')"
                                />
                            </el-select>
                        </el-form-item>
                        <el-form-item prop="room" class="w-full" :error="serverErrors.roomId">
                            <el-select
                                v-model="form.roomId"
                                class="w-full"
                                filterable
                                clearable
                                :placeholder="$t('meeting room')"
                            >
                                <el-option
                                    v-for="room in rooms"
                                    :key="$get(room, 'id')"
                                    :label="$get(room, 'name')"
                                    :value="$get(room, 'id')"
                                />
                            </el-select>
                        </el-form-item>
                        <el-form-item :label="$t('online meeting')" prop="isOnline" :error="serverErrors.isOnline">
                            <el-switch v-model="form.isOnline" />
                        </el-form-item>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-5">
                <el-button type="info" plain @click="close">{{ $t('cancel') }}</el-button>
                <el-button type="info" @click="resetForm">{{ $t('reset') }}</el-button>
                <el-button
                    type="primary"
                    :loading="processing"
                    @click="submit($refs.form, submitForm)"
                >
                    {{ $t('next') }}
                    <span class="material-icons-outlined ml-2 text-base">arrow_forward_ios</span>
                </el-button>
            </div>
        </el-form>
        <SendMailForm
            v-else
            :mail-templates="mailTemplates"
            :interview="interview"
            :close="close"
        />
    </el-dialog>
</template>
<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';
    import SendMailForm from './SendMailForm.vue';

    export default {
        name: 'InterviewForm',

        components: {
            SendMailForm,
        },

        mixins: [formMixin, mixin],
    };
</script>
