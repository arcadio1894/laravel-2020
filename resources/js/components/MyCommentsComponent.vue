<template>
    <div class="col-md-8">

        <form-component v-bind:id_course="course_id"
            v-on:new="addComment">
        </form-component>
        <h4 class="section-title-underline mb-2">
            <span>Leer comentarios</span>
        </h4>
        <comment-component
            v-for="(comment, index) in comments"
            v-bind:key="comment.id"
            v-bind:comment="comment"
            v-on:delete="deleteComment(index)"
            v-on:update="updateComment(index, ...arguments)"
            v-on:modal="showModal(index, ...arguments)" >
        </comment-component>
        <div id="modalEditar" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" v-on:click="onClickCancel" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text">
                        <input type="text" v-model="productEdit">
                        <input type="text" v-model="descriptionEdit">
                        <input type="text" v-model="precioEdit">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" v-on:click="onClickCancel" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>

<script>
    export default {
        props: ['course_id'],
        data() {
            return {
                comments: [],
                openModal:false,
                idproduct:'',
                productEdit: '',
                descriptionEdit:'',
                precioEdit:'',
                habilitadoEdit:''
            }
        },
        mounted() {
            axios.get('/comments/'+this.course_id)
                .then(
                    (response) => {
                        this.comments = {};
                        this.comments = response.data
                    }
                )
        },
        methods: {
            addComment(comment) {
                this.comments.push(comment)
            },
            deleteComment(index) {
                this.comments.splice(index,1)
            },
            updateComment(index, comment) {
                this.comments[index] = comment;
                console.log(this.comments[index].course_id);
            },
            showModal(index, comment){
                this.openModal = true;
                this.productEdit = comment.id;
                this.descriptionEdit = comment.message;
                this.precioEdit = comment.id;
                $('#modalEditar').show();
            },
            onClickCancel() {
                this.openModal = false;
                this.productEdit = "";
                this.descriptionEdit = "";
                this.precioEdit = "";
                $('#modalEditar').hide();
            }
        }
    }
</script>
