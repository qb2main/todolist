<template>
    <v-card>
        <v-layout>

            <v-app-bar
                color="blue"
                prominent
            >
                <v-toolbar-title>To Do List</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-btn
                    @click="addTask()"
                    variant="text"
                    icon="mdi-plus"
                ></v-btn>

            </v-app-bar>

            <v-main style="height: auto">
                <v-card-text>
                    <v-table>
                        <thead>
                        <tr>
                            <th class="text-left">
                                Task
                            </th>
                            <th class="text-left">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, task_index) in tasks"
                            :key="item.name"
                        >
                            <td>
                                <span v-bind:class="setDoneClass(item)">
                                    {{ item.name }}
                                </span>
                            </td>
                            <td>
                                <v-btn
                                    @click="finishTask(item)"
                                    size="small"
                                    v-if="(!item.done)"
                                    color="blue"
                                >
                                    Finish
                                </v-btn>
                                <v-btn
                                    @click="deleteTask(item, task_index)"
                                    size="small"
                                    color="red"
                                >
                                    Delete
                                </v-btn>
                            </td>
                        </tr>
                        </tbody>
                    </v-table>
                </v-card-text>
            </v-main>
        </v-layout>
<!--        <task-form ref="form" @new-task-added="addNewTaskToVueData"></task-form>-->
        <task-form ref="form" @new-task-added="getTasks"></task-form>
    </v-card>
</template>

<style>
.crossed-out {
    text-decoration: line-through;
}
</style>

<script>

export default {
    data() {
        return {
            tasks: [],
        }
    },

    mounted() {
        this.initialize();

        window.Echo.channel('my_task_channel')
            .listen('TaskFinished', ({source_file_id}) => {
                //do something
                this.getTasks();
            });
    },

    methods: {
        initialize() {
            this.getTasks();
        },
        getTasks() {
            const this_value = this;
            axios
                .get('/api/v1/tasks')
                .then(function (response) {
                    this_value.tasks = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        addTask() {
            this.$refs.form.dialog = true;
        },
        finishTask(task) {
            const this_value = this;
            axios
                .put('/api/v1/tasks/' + task.id, {
                    'name': task.name,
                    'done': true,
                })
                .then(function (response) {
                    let updated_task = response.data.data;
                    task.done = updated_task.done;
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        deleteTask(task, task_index) {
            const this_value = this;
            axios
                .delete('/api/v1/tasks/' + task.id)
                .then(function (response) {
                   this_value.tasks.splice(task_index, 1)
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        setDoneClass(task) {
            return task.done ? 'crossed-out' : '';
        },
        addNewTaskToVueData(newTask) {
            this.tasks.push(newTask);
        }
    }
}
</script>
