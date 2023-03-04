<template>
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
            v-for="item in desserts"
            :key="item.name"
        >
            <td>{{ item.name }}</td>
            <td>
                <v-btn>
                    Edit
                </v-btn>
            </td>
        </tr>
        </tbody>
    </v-table>
</template>
<script>
export default {
    data() {
        return {
            desserts: [
                {
                    name: 'Task1'
                },
                {
                    name: 'Task2'
                }
            ],
        }
    },
}
</script>
