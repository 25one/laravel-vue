<template>
   <div>
      <input type="text" name="newsletter_input_message" class="newsletter_input message" placeholder="Ваше сообщение" v-model="mailData.message">  <!-- message -->
      <input type="text" name="newsletter_input_email" class="newsletter_input email" placeholder="Ваш контакт(email, skype,...)" v-model="mailData.contact">  <!-- contact -->
      <br>
      <button type="button" class="newsletter_button" @click="mailer">></button><br>
   </div> 
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2';

    export default {
        data: function() {
           return {
            mailData: {
              message: '',
              contact: '',
            },
            //message: '',
            //contact: '', 
           }
        },
        mounted() {
           //...
        },
        methods: { 
           mailer() {
             let app = this; //!!!app - becouse axios
             axios
              .post('/mailer', this.mailData) //{this.message, this.contact}
                .then(function (resp) {
                     console.log(resp.data);

                     if (resp.data.mail) {
                        app.mailData.message = '';
                        app.mailData.contact = '';                        

                        Swal.fire({
                           title: "Сongratulations!",
                           text: "Your message has been sending successfully!",
                           icon: "success",
                        });
                     } else {
                        Swal.fire({
                           title: "Oops!",
                           text: "There is any mistake!",
                           icon: "error",
                        });               
                     }	                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not mail message");
                });       
           }, 
        },
    }
</script>