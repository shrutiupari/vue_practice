import { mount } from '@vue/test-utils'
import SendOtp from '@/components/SendOtp.vue'
import axios from 'axios'

jest.mock('axios')

describe('SendOtp.vue', () => {
  it('displays success alert on successful OTP send', async () => {
    axios.post.mockResolvedValueOnce({})
    const wrapper = mount(SendOtp)

    await wrapper.find('input').setValue('+1234567890')
    await wrapper.find('form').trigger('submit.prevent')

    await wrapper.vm.$nextTick()
    expect(wrapper.html()).toContain('OTP sent successfully!')
  })

  it('displays error alert on failure', async () => {
    axios.post.mockRejectedValueOnce({ response: { data: { message: 'API error' } } })
    const wrapper = mount(SendOtp)

    await wrapper.find('input').setValue('+1234567890')
    await wrapper.find('form').trigger('submit.prevent')

    await wrapper.vm.$nextTick()
    expect(wrapper.html()).toContain('Failed to send OTP: API error')
  })
})