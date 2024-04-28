<template>
    <div>
        <hr />
        <h4>Add New Comment</h4>
        <div class="comment_items">
           <div class="row m-2">
              <div class="col-xl-6">
                 <textarea class="w-100 p-2" rows="3" placeholder="New Comment" v-model="newComment"></textarea>
              </div> 
               <div class="col-xl-6">
                  <div class="form-check">
                     <input class="form-check-input" name="rating" type="radio" value="1" :checked="rating === '1'" @change="handleRating('1')" />
                     <div class="rating_r rating_r_1 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="rating" type="radio" value="2" :checked="rating === '2'" @change="handleRating('2')" />
                     <div class="rating_r rating_r_2 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="rating" type="radio" value="3" :checked="rating === '3'" @change="handleRating('3')" />
                     <div class="rating_r rating_r_3 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  </div>                                                
                  <div class="form-check">
                     <input class="form-check-input" name="rating" type="radio" value="4" :checked="rating === '4'" @change="handleRating('4')" />
                     <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" name="rating" type="radio" value="5" :checked="rating === '5'" @change="handleRating('5')" />
                     <div class="rating_r rating_r_5 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
                  </div>
               </div>              
           </div>
           <div class="row m-2">
              <div class="col-xl-6">
                 <button class="btn btn-info" @click="addComment">add comment</button>
              </div> 
           </div>           
        </div>
        <hr />
        <h4>Comment's List</h4>
        <div class="comment_items">
           <ul class="comment_items_list">
                <!-- Comment Item -->                                  
                <li v-for="comment, index in comments">
                  <div class="row m-2">
                    <div class="col-xl-1 border text-center p-2" v-if="user.role ==='admin' || (comment.user_id === user.id)">
                        <button class="btn btn-light" :value="comment.id" @click="removeComment">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                    </div>  
                    <div class="col-xl-1" v-else>
                    </div>                                       
                    <div class="col-xl-3 border text-center p-2">
                        {{comment.comment}}
                    </div>
                    <div class="col-xl-3 border text-center p-2">
                        {{comment.created_at}}
                    </div>  
                     <div class="col-xl-3 border text-center p-2">
                        <div :class="'rating_r rating_r_' + comment.rating + ' product_rating'"><i></i><i></i><i></i><i></i><i></i></div> 
                     </div>                                      
                  </div>  
                </li>
               <!-- Comment Item -->
           </ul>
        </div> 
    </div>             
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2';

    export default {
        data: function() {
           return {
              user: window.user,
              product: window.product,
              comments: window.product.comments,
              newComment: '',
              rating: '0', //!!!default
           }
        },      
        mounted() {
           //...
        },
        methods: { 
           handleRating(value) {
              this.rating = value;    
           },

           addComment() { 
             if (this.newComment) {
               let app = this; //!!!app - becouse axios

               axios
               .post('/addcomment', {id: product.id, comment: this.newComment, rating: this.rating})
                  .then(function (resp) {
                     console.log(resp.data);
                     app.comments = resp.data.comments; //!!!app - becouse axios  

                     app.newComment = '';  
                     app.rating = '0';                                    
                  })
                  .catch(function (resp) {
                     console.log(resp.response);

                     let errors = resp.response.data.errors; //!!!check from console browser
                     let titleErrors = '';
                     for (let i in errors) {
                        titleErrors += i + ' - ' + errors[i];
                     }
  
                     Swal.fire({
                        icon: 'error',
                        text: titleErrors,
                     });                                          
                  });
              } else {
                  Swal.fire({
                     icon: 'error',
                     text: 'Field New Comment must be filled in!',
                  });                
              }
           },

           removeComment(event) { 
             let commentId = event.currentTarget.value;

             let app = this; //!!!app - becouse axios

             axios
              .post('/removecomment', {id: product.id, commentId: commentId}) //!!!plus id: product.id
                .then(function (resp) {
                    console.log(resp.data);
                    app.comments = resp.data.comments; //!!!resp.data.comments                    
                })
                .catch(function (resp) {
                    console.log(resp.response);
                    //alert("Could not delete comment");
                    //alert(resp.response.data.message); 
                    Swal.fire({
                       icon: 'error',
                       text: resp.response.status + ' ' + resp.response.statusText + ' ' + resp.response.data.message,
                    }); 
                });      
           },

        },
    }
</script>
