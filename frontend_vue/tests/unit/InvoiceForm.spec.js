import { mount } from '@vue/test-utils';
import InvoiceForm from '@/components/InvoiceForm.vue';
import Vuetify from 'vuetify';
import { createVuetify } from 'vuetify';
import { nextTick } from 'vue';

// Setup Vuetify instance for testing
const vuetify = createVuetify();

describe('InvoiceForm.vue', () => {
  it('emits invoiceCreated on successful submit', async () => {
    const wrapper = mount(InvoiceForm, {
      global: {
        plugins: [vuetify],
      }
    });

    // Set values on v-text-fields
    const numberField = wrapper.find('input[name="number"]');
    const amountField = wrapper.find('input[name="amount"]');
    const dueDateField = wrapper.find('input[name="dueDate"]');

    await numberField.setValue('INV-101');
    await amountField.setValue('500');
    await dueDateField.setValue('2025-07-01');

    // Trigger form submission
    await wrapper.find('form').trigger('submit.prevent');
    await nextTick();

    // Check if the event was emitted
    expect(wrapper.emitted('invoiceCreated')).toBeTruthy();
  });
});
