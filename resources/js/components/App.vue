<template>
    <div class="container">
        <div class="row">
            <div class="col s10" v-if="!showCodeForm">
                <br />
                <br />
                <h3>Vă rugăm să vă logați</h3>
                <br />
                <form @submit.prevent="onSumbit(formData)">
                    <div class="input-field">
                        <input
                            name="identifier"
                            id="usr"
                            type="text"
                            class="validate valid"
                            v-model="formData.username"
                            required
                        />
                        <label for="usr" class="active">Nume utilizator</label>
                    </div>
                    <div class="input-field">
                        <input
                            name="password"
                            id="pss"
                            type="password"
                            class="validate valid"
                            v-model="formData.password"
                            required
                        />
                        <label for="pss" class="active">Parolă</label>
                    </div>
                    <br />
                    <br />
                    <button class="btn green">Continuă</button>
                </form>
            </div>
            <div class="col s10" v-if="showCodeForm">
                <br />
                <br />
                <h3>Introduceți codul din email</h3>
                <br />
                <form @submit.prevent="verifyCode(tfaData)">
                    <div class="input-field">
                        <input
                            name="code"
                            id="code"
                            class="validate valid"
                            v-model="tfaData.code"
                            required
                        />
                        <label for="code" class="active">Parolă</label>
                    </div>
                    <br />
                    <button class="btn green">Logare</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            showCodeForm: false,
            tfaData: {
                code: "",
                loginAttemptId: 0,
            },
            formData: {
                username: "",
                password: "",
            },
        };
    },
    methods: {
        onSumbit(form) {
            axios.post("/api/auth/login", form).then((res) => {
                this.showCodeForm = true;
                this.tfaData.loginAttemptId = res.data.login_attempt_id;
            });
        },
        verifyCode(form) {
            axios
                .post("/api/auth/verify-code", form)
                .then((res) => {
                    alert("Success");
                })
                .catch((err) => alert("Wrong code"));
        },
    },
};
</script>
