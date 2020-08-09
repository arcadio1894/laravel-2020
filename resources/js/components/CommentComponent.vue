<template>
    <div class="col-md-12">
        <div class="ftco-testimonial-1">

            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img v-bind:src="comment.photo" alt="Image" class="img-fluid mr-3">

                <div>
                    <h3>{{ comment.user }}</h3>
                    <span>Publicado el {{ comment.created_at | formatDate  }} - Modificado {{ comment.updated_at | formatDateUpdate  }} </span>
                </div>

            </div>
            <div>
                <div v-if="editMode" class="col-md-12">
                    <textarea name="message" cols="10" rows="3" class="form-control"
                        v-model="comment.message">

                    </textarea>
                </div>

                <p v-else >{{ comment.message }}</p>

                <div v-if="editMode" >
                    <button class="btn btn-primary"
                            v-on:click="onClickUpdate"> <span class="icon-save"></span> </button>
                    <button class="btn btn-danger"
                            v-on:click="onClickCancel"> <span class="icon-cancel"></span> </button>
                    <br>
                </div>

                <div v-else>
                    <button class="btn btn-primary"
                            v-on:click="onClickEdit"> <span class="icon-pencil"></span> </button>
                    <button class="btn btn-danger"
                            v-on:click="onClickDelete"> <span class="icon-trash"></span> </button>
                    <br>
                </div>

            </div>
        </div>


    </div>

</template>

<script>
    export default {
        props: ['comment'],
        data() {
            return {
                editMode: false,
            }
        },
        filters: {
            formatDate: function (value) {
                if (value) {
                    return moment(String(value)).format('DD/MM/YYYY hh:mm');
                }
            },
            formatDateUpdate: function (value) {
                if (value) {
                    moment.locale('es');
                    return moment(String(value)).fromNow();
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            onClickEdit() {
                //this.editMode = true;
                this.$emit('modal', this.comment);
            },
            onClickCancel() {
                this.editMode = false;
                this.showModal = false;
                this.idproduct = "";
                this.productEdit = "";
                this.descriptionEdit = "";
                $('#modalEditar').hide();
            },
            onClickDelete() {
                axios.delete('/comment/'+this.comment.id)
                    .then(
                        () => {
                            this.$emit('delete');
                        }
                    )
            },
            onClickUpdate() {
                const params = {
                    message: this.comment.message,
                    course_id: this.comment.course_id,
                };

                axios.put('/comment/'+this.comment.id, params)
                    .then(
                        (response) => {
                            this.editMode = false;
                            const commentario = response.data;
                            this.comment = commentario;
                            this.$emit('update', commentario);
                        }
                    )
            }
        }
    }
</script>
