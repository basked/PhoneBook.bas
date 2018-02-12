<template>
    <div class="modal" :class='openmodal'> <!--is-active - Активное-->
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Person</p>
                <button class="delete" aria-label="close" @click="close"></button>
            </header>
            <section class="modal-card-body">

                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Table number</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.tn}" type="text" placeholder="Table number" v-model="list.tn">
                    </div>
                    <small v-if="errors.tn" class="has-text-danger">{{errors.tn[0]}}</small>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Name</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.name}" type="text" placeholder="Name" v-model="list.name">
                    </div>
                    <small v-if="errors.name" class="has-text-danger">{{errors.name[0]}}</small>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Last name</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.lastname}" type="text" placeholder="Last name" v-model="list.lastname">
                    </div>
                    <small v-if="errors.lastname" class="has-text-danger">{{errors.lastname[0]}}</small>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Patronymic</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.patronymic}"  type="text" placeholder="Patronymic" v-model="list.patronymic">
                    </div>
                    <small v-if="errors.patronymic" class="has-text-danger">{{errors.patronymic[0]}}</small>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Birthday</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.birthday}" type="text" placeholder="Birthday" v-model="list.birthday">
                    </div>
                    <small v-if="errors.birthday" class="has-text-danger">{{errors.birthday[0]}}</small>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Phone mobile</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.phone_mobile}" type="tel" placeholder="Phone mobile" v-model="list.phone_mobile">
                    </div>
                    <small v-if="errors.phone_mobile" class="has-text-danger">{{errors.phone_mobile[0]}}</small>
                </div>
                <div class="field">
                    <label class="label" style="color: #0a0a0a;text-align: left">Phone home</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger':errors.phone_home}" type="tel" placeholder="Phone home" v-model="list.phone_home">
                    </div>
                    <small v-if="errors.phone_home" class="has-text-danger">{{errors.phone_home[0]}}</small>
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
                    phone_mobile: '375298210344',
                    phone_home: '425555'
                },
                errors:{}
            }
        },

        methods: {
            close(){
                this.$emit('closeRequest')
            },
            save(){
                axios.post('/phonebook', this.$data.list)
                    .then((response) => this.close())
                    .catch((error) => this.errors=error.response.data.errors)
            }
        }
    }
</script>