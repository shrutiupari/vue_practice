<!-- BaseInput.vue -->
<template>
  <v-container>
    <v-card>
      <v-card-title>Base Input</v-card-title>
      <v-card-text>
        <v-text-field
          :label="label"
          v-model="inputValue"
          :rules="[(v) => !!v || 'Required']"
          data-testid="base-input"
        />
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { defineProps, defineEmits, watch, ref } from 'vue'

const props = defineProps({ label: String, modelValue: String })
const emit = defineEmits(['update:modelValue'])

const inputValue = ref(props.modelValue)

watch(inputValue, (val) => emit('update:modelValue', val))
</script>
