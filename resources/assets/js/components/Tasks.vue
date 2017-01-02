<template>
    <div>

    <h1>User</h1>
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>firstName</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody name="fade" is="transition-group">

                <tr v-for="task in list" v-bind:key="task.id">
                    <td><input type="checkbox" @click="task.completed = !task.completed" :value = "task.id" v-model = "checkedNames"></td>
                    <td>{{task.name}}</td>
                    <td>{{task.email}}</td>
                </tr>


            </tbody>
        </table>

        <button class="btn btn-primary" @click="submits">Submit</button>
    </div>
</template>
<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
        opacity: 0
    }
</style>
<script>
    export default{
        data(){
            return{
             checkedNames: [],
             list:[],
             task: {
                 name: '',
                 email: '',
                 completed: false
             },
             filters: {
                 notDone: function(todo) {
                    return ! todo.completed;
                 },
                 completed: function(todo) {
                    return todo.completed;
                 }
             },
        }
    },

    created:function() {
        this.fetchTaskList();
    },
    methods: {
        fetchTaskList: function()
        {
            this.$http.get('api/users').then(function (response) {
            this.list = response.data
            });
        },
        submits: function () {
            this.list = this.list.filter(this.filters.notDone);
            this.$http.post('api/destroy', {id :this.checkedNames }).then((response) => {
                        console.log();
                }, (response) => {
                        // error callback
            });
        },
    },

    computed: {
        finished: function() {
            return this.task.filter(this.filters.completed);
        },
        pending: function() {
            return this.task.filter(this.filters.notDone);
        }
    },
}
</script>
