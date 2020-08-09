<template>

    <div class="col-md-10">
        <div class="col-md-12 form-group mb-lg-3">
            <form v-on:submit.prevent="newComment">
                <label for="message">¿ En que estás pensando ?</label>
                <textarea v-model="message" id="message" name="message" cols="30" rows="2" class="form-control"></textarea>
                <br>
                <button type="submit" class="btn btn-success">Enviar <span class="icon-arrow-circle-right"></span> </button>
            </form>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['id_course'],
        data() {
            return {
                message: ''
            }
        },
        created() {
            console.log('Component mounted.')
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newComment() {
                const params = {
                    message: this.message,
                    course_id: this.id_course,
                    photo: 'http://127.0.0.1:8000/landing/images/person_1.jpg'
                };
                this.message = '';

                // Peticion AXIOS
                axios.post('/comments', params)
                    .then(
                        (response) => {
                            const comment = response.data;
                            this.$emit('new', comment);
                        }
                    )
            }
        }
    }
</script>
