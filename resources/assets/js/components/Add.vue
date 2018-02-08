<template>
    <div class="modal" :class='openmodal'> <!--is-active - Активное-->
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Modal title</p>
                <button class="delete" aria-label="close" @click="close"></button>
            </header>
            <section class="modal-card-body">

                <div class="field">
                    <label class="label" style="color: #0a0a0a;">Table Number</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Table Number" v-model="list.tn">
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;">Name</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Name" v-model="list.name">
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;">LastName</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="LastName" v-model="list.lastname">
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;">Patronymic</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Patronymic" v-model="list.patronymic">
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;">Birthday</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Birthday" v-model="list.birthday">
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;">Birthday</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Phone mobile" v-model="list.phone_mobile">
                    </div>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;">Phone home</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Birthday" v-model="list.phone_home">
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click='save'>Save changes</button>
                <button class="button" @click="close">Cancel</button>
            </footer>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['openmodal'],
        data(){
            return {
                list: {
                    tn: 2398,
                    name: 'Dzmitry',
                    lastname: 'Misiulia',
                    patronymic: 'Nikolaevich',
                    birthday: '10.09.1986',
                    phone_mobile: '+375 29 821-03-44',
                    phone_home: '42-55-55'

                }
            }
        },
        methods: {
            close(){
                this.$emit('closeRequest')
            },
            save(){
                axios.post('/phonebook', this.$data.list)
                    .then((response) => this.close())
                    .catch((error) => console.log(error))
            }
        }
    }
</script>