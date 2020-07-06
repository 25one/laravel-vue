<template>
  <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div id="myDIV" class="header">
          <h2 style="margin:5px">My To Do List</h2>
          <input type="text" id="myInput" placeholder="Title..." v-model="createtask.name" v-on:keyup.enter="createTask()">
          <span class="addBtn" v-on:click="createTask()">Add</span>
        </div>
        <div>
           <ul id="myUL" v-for="task, index in tasks">
              <li v-bind:id="task.id" v-bind:class="{checked: task.result}" v-on:click="updateTask(task.id)">{{ task.name }}<span v-if="task.result" v-bind:id="task.id" v-on:click.self="destroyTask(index, task.id)" class="close">×</span></li>
           </ul>
        </div>   
      </div>  
      <div class="col-md-3">
      </div>    
  </div>
</template>

<script>
    export default {
        data: function() {
           return {
              tasks: [], 
              createtask: {
                 name,
                 //...
              },
           }
        },
        mounted() {
           this.listTasks();
        },
        methods: {
           listTasks: function(){
             var app = this;
             axios
              .get('./api/tasks')          
                .then(function (resp) {
                    app.tasks = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load tasks");
                });
           }, 
           createTask(){
             var app = this;
             var newTask = app.createtask;           
             axios
              .post('./api/tasks', newTask)
                .then(function (resp) {
                    //app.listTasks();
                    app.tasks = resp.data;
                    app.createtask.name = '';
                    //...
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not create task");
                });
           },  
           updateTask(id){
             var app = this;
             var newTask = app.createtask;           
             axios
              .put('./api/tasks/' + id, {})
                .then(function (resp) {
                    //app.listTasks();
                    app.tasks = resp.data;
                    app.createtask.name = '';
                    //...
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not update task");
                });            
           },    
           destroyTask(index, id){
             var app = this;
             axios
              .delete('./api/tasks/' + id)
                .then(function (resp) {
                    //app.listTasks();
                    //app.tasks = resp.data;
                    app.tasks.splice(index, 1);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not delete task");
                });            
           },                                    
        },
    }
</script>
