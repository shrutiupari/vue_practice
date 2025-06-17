import { mount } from '@vue/test-utils'
import SendOtp from '@/components/SendOtp.vue'
import { describe, it, expect, vi, beforeEach } from 'vitest'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// ✅ Create Vuetify instance
const vuetify = createVuetify({
  components,
  directives,
})

// ✅ Mock global fetch
global.fetch = vi.fn(() =>
  Promise.resolve({
    ok: true,
    json: () => Promise.resolve({}),
  })
)

describe('SendOtp.vue', () => {
  let wrapper

  beforeEach(() => {
    wrapper = mount(SendOtp, {
      global: {
        plugins: [vuetify],
      },
    })
  })

  it('renders phone input and send button', () => {
    expect(wrapper.get('[data-testid="phone-input"]')).toBeTruthy()
    expect(wrapper.get('[data-testid="send-btn"]')).toBeTruthy()
  })

  it('sends OTP and shows success message', async () => {
    await wrapper.get('[data-testid="phone-input"]').setValue('1234567890')
    await wrapper.get('[data-testid="send-btn"]').trigger('click')

    await wrapper.vm.$nextTick()

    expect(wrapper.get('[data-testid="status-msg"]').text()).toBe('OTP sent!')
  })
})
