<template>
  <li :class="{ completed: task.completed }">
    <span @click="$emit('complete')">{{ task.text }}</span>
    <button @click="$emit('remove')"><i class="fas fa-trash"></i></button>
  </li>
</template>

<script setup>
defineProps(['task'])
defineEmits(['remove', 'complete'])
</script>

<style scoped>
li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 14px;
  border: 1px solid #e0e0e0;
  margin-bottom: 10px;
  border-radius: 8px;
  background-color: #f9f9f9;
  transition: all 0.3s;
}

li:hover {
  background-color: #f0f0f0;
}

li span {
  cursor: pointer;
  font-size: 16px;
  flex-grow: 1;
}

li.completed span {
  text-decoration: line-through;
  color: #888;
}

li button {
  background-color: transparent;
  border: none;
  color: #f44336;
  font-size: 18px;
  cursor: pointer;
}
</style>
