<template>
  <div class="container">
    <div class="task">
      <div class="title">
        <h1>🌞 To Do List</h1>
      </div>

      <div class="form">
        <input type="text" placeholder="Add a task..." v-model="newTask" @keyup.enter="addTask" />
        <v-btn title="Add Note" @click="addTask" class="far mdi-plus-box-outline"
          >Add Note<i class="fas fa-plus"></i
        ></v-btn>
      </div>

      <div class="taskItems">
        <ul>
          <task-item
            v-for="(task, index) in tasks"
            :key="task.id"
            :task="task"
            @remove="() => removeTask(index)"
            @complete="() => completeTask(task)"
          />
        </ul>
      </div>

      <div class="clearBtns">
        <button @click="clearComplete()">Clear Completed</button>
        <button @click="clearAll()">Clear All</button>
      </div>

      <div class="pendingTasks">
        <span>Pending Tasks: {{ incomplete }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import TaskItem from './TaskItem.vue'

const newTask = ref('')
const tasks = ref([])

const incomplete = computed(() => tasks.value.filter((task) => !task.completed).length)

function addTask() {
  if (newTask.value.trim()) {
    tasks.value.push({
      id: Date.now(),
      text: newTask.value.trim(),
      completed: false,
    })
    newTask.value = ''
  }
}

function completeTask(task) {
  task.completed = !task.completed
}

function removeTask(index) {
  tasks.value.splice(index, 1)
}

function clearComplete() {
  tasks.value = tasks.value.filter((task) => !task.completed)
}

function clearAll() {
  tasks.value = []
}
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 50px auto;
  padding: 24px;
  background-color: #fffde7; /* soft cream */
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  font-family: 'Segoe UI', Tahoma, sans-serif;
}

.title h1 {
  text-align: center;
  color: #f9a825; /* golden yellow */
  margin-bottom: 24px;
  font-weight: 600;
}

.form {
  display: flex;
  gap: 10px;
  margin-bottom: 20px;
}

.form input {
  flex: 1;
  padding: 12px;
  font-size: 16px;
  border: 2px solid #fff176;
  border-radius: 10px;
  background-color: #fff;
}

.form button {
  background-color: #fbc02d;
  color: #333;
  border: none;
  padding: 12px 16px;
  font-size: 16px;
  border-radius: 10px;
  cursor: pointer;
}

.form button:hover {
  background-color: #f9a825;
}

.clearBtns {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.clearBtns button {
  background-color: #fdd835;
  color: #333;
  border: none;
  padding: 8px 14px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
}

.clearBtns button:hover {
  background-color: #fbc02d;
}

.pendingTasks {
  margin-top: 15px;
  text-align: center;
  font-weight: 600;
  color: #555;
}
</style>
