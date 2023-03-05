<template>
    <v-row justify="center">
        <v-dialog
            v-model="dialog"
            persistent
            width="1024"
        >
            <v-card>
                <v-card-title>
                    <span class="text-h5">Add new task</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="name"
                                    label="To do text"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="dialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="createTask()"
                    >
                        Add
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
export default {
    data: () => ({
        task: [],
        dialog: false,
        name: null
    }),
    methods: {
        createTask() {
            const this_value = this;
            axios
                .post('/api/v1/tasks', {
                    'name': this.name,
                })
                .then(function (response) {
                    let new_task = response.data.data
                    this_value.task = new_task
                    this_value.dialog = false
                    this_value.clearForm();
                    this_value.$emit('new-task-added', this_value.task);
                })
                .catch(function (error) {
                    console.log(error);
                })
        },
        clearForm() {
            this.name = '';
        }
    }
}
</script>
