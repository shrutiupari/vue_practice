import { vi } from 'vitest'

// Mock CSS modules (optional if you still get CSS errors)
vi.stubGlobal('CSS', { supports: () => false })
