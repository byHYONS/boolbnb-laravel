# GitHub Copilot Chat - Keybindings Reference

## Quick Reference Card

### Leader Key
- `<Space>` = Leader key

### 🤖 GitHub Copilot Chat

#### Basic Chat Commands
| Key Combination | Action | Mode |
|---|---|---|
| `<Space>cc` | Open Copilot Chat | Normal |
| `<Space>cc` | Chat about selected code | Visual |
| `<Space>ccq` | Close Copilot Chat | Normal |
| `<Space>ccr` | Reset Chat history | Normal |
| `<Space>cct` | Toggle Chat window | Normal |

#### Code Analysis (Visual Mode - Select code first)
| Key Combination | Action | Description |
|---|---|---|
| `<Space>ce` | Explain code | Get explanation of selected code |
| `<Space>cf` | Fix code | Get suggestions to fix selected code |
| `<Space>co` | Optimize code | Get performance optimization suggestions |
| `<Space>ct` | Generate tests | Generate PHPUnit tests for selected code |

#### Laravel-Specific Prompts
| Key Combination | Action | Description |
|---|---|---|
| `<Space>cd` | DocBlock | Add PHP DocBlock comments |
| `<Space>cm` | Migration | Generate Laravel migration |
| `<Space>cM` | Model | Generate Laravel Eloquent model |
| `<Space>cC` | Controller | Generate Laravel controller |

### 🚀 Laravel Development

| Key Combination | Action | Description |
|---|---|---|
| `<Space>la` | Artisan command | Run php artisan command |
| `<Space>lt` | Run tests | Execute PHPUnit tests |
| `<Space>lm` | Run migrations | Execute database migrations |
| `<Space>lr` | List routes | Show all application routes |

### 📁 File Navigation

| Key Combination | Action | Description |
|---|---|---|
| `<Space>ff` | Find files | Fuzzy find files |
| `<Space>fg` | Live grep | Search in files content |
| `<Space>fb` | Find buffers | Switch between open files |

### 💻 LSP Features

| Key Combination | Action | Description |
|---|---|---|
| `gd` | Go to definition | Jump to symbol definition |
| `K` | Show hover | Display documentation |
| `<Space>ca` | Code actions | Show available code actions |
| `<Space>rn` | Rename symbol | Rename symbol across project |

### 📝 General Editing

| Key Combination | Action | Description |
|---|---|---|
| `<Space>w` | Save file | Write current file |
| `<Space>q` | Quit | Close current window |
| `<Space>x` | Save & quit | Save and close |

### 🎮 Copilot Suggestions (Insert Mode)

| Key Combination | Action | Description |
|---|---|---|
| `Ctrl+j` | Next suggestion | Cycle to next Copilot suggestion |
| `Ctrl+k` | Previous suggestion | Cycle to previous suggestion |
| `Ctrl+l` | Accept word | Accept only the next word |
| `Ctrl+h` | Dismiss | Dismiss current suggestion |

## Chat Window Controls

When inside the Copilot Chat window:

| Key | Action | Mode |
|---|---|---|
| `q` | Close chat | Normal |
| `Ctrl+c` | Close chat | Insert |
| `Enter` | Submit prompt | Normal |
| `Ctrl+m` | Submit prompt | Insert |
| `Ctrl+r` | Reset history | Normal |
| `Ctrl+y` | Accept diff | Normal |
| `gd` | Toggle diff mode | Normal |
| `gs` | Toggle sticky mode | Normal |

## Workflow Examples

### 1. Code Review Workflow
1. Select problematic code in visual mode
2. Press `<Space>ce` to get explanation
3. Press `<Space>cf` to get fix suggestions
4. Press `<Space>co` to optimize if needed

### 2. Test Generation Workflow
1. Select function/method in visual mode
2. Press `<Space>ct` to generate tests
3. Review generated test code
4. Press `Ctrl+y` to accept if satisfied

### 3. Laravel Development Workflow
1. Press `<Space>cm` to generate migration
2. Press `<Space>cM` to generate model
3. Press `<Space>cC` to generate controller
4. Press `<Space>lt` to run tests

### 4. Bug Fixing Workflow
1. Open chat with `<Space>cc`
2. Describe the issue
3. Get suggestions and explanations
4. Apply fixes and test with `<Space>lt`

## Tips

- **Visual Selection**: Most Copilot commands work better when you select specific code first
- **Context Matters**: Copilot Chat considers your current file and project structure
- **Iterative Development**: Use chat history to build on previous conversations
- **Laravel Specific**: The prompts are optimized for Laravel conventions and best practices

## Customization

To modify keybindings, edit the `init.lua` file in the keymap sections. The structure is:
```lua
vim.keymap.set('mode', '<key>', '<command>', { desc = "description" })
```

Where:
- `mode` = 'n' (normal), 'i' (insert), 'v' (visual)
- `<key>` = key combination
- `<command>` = command to execute
- `desc` = description for help