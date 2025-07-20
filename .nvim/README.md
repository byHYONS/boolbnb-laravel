# Neovim Configuration for BoolBnB Laravel Project

This directory contains Neovim configuration optimized for Laravel development with GitHub Copilot Chat support.

## Setup Instructions

### Prerequisites

1. **Neovim 0.8+** - Make sure you have a recent version of Neovim installed
2. **Git** - Required for plugin management
3. **Node.js** - Required for GitHub Copilot
4. **GitHub Copilot Subscription** - Active GitHub Copilot subscription

### Installation Methods

#### Method 1: Global Configuration (Recommended)

1. Copy the `init.lua` file to your Neovim configuration directory:
   ```bash
   cp .nvim/init.lua ~/.config/nvim/init.lua
   ```

2. Start Neovim - plugins will automatically install on first launch:
   ```bash
   nvim
   ```

#### Method 2: Project-Specific Configuration

1. Create a local nvim configuration:
   ```bash
   mkdir -p ~/.config/nvim-boolbnb
   cp .nvim/init.lua ~/.config/nvim-boolbnb/init.lua
   ```

2. Create an alias to use this configuration:
   ```bash
   alias nvim-laravel='NVIM_APPNAME=nvim-boolbnb nvim'
   ```

3. Use the alias to start nvim with Laravel-specific configuration:
   ```bash
   nvim-laravel
   ```

### GitHub Copilot Setup

1. First time setup - authenticate with GitHub:
   ```vim
   :Copilot setup
   ```

2. Follow the authentication instructions in your browser

3. Enable Copilot Chat:
   ```vim
   :CopilotChat
   ```

## Key Bindings

### General Navigation
- `<Space>` - Leader key
- `<leader>w` - Save file
- `<leader>q` - Quit
- `<leader>x` - Save and quit

### GitHub Copilot
- `Ctrl+j` - Next suggestion (insert mode)
- `Ctrl+k` - Previous suggestion (insert mode)
- `Ctrl+l` - Accept word (insert mode)
- `Ctrl+h` - Dismiss suggestion (insert mode)

### GitHub Copilot Chat
- `<leader>cc` - Open Copilot Chat
- `<leader>ccq` - Close Copilot Chat
- `<leader>ccr` - Reset Chat history
- `<leader>cct` - Toggle Chat window

#### Visual Mode (Select code first)
- `<leader>cc` - Chat about selected code
- `<leader>ce` - Explain selected code
- `<leader>cf` - Fix selected code
- `<leader>co` - Optimize selected code
- `<leader>ct` - Generate tests for selected code

#### Laravel-Specific Prompts
- `<leader>cd` - Add DocBlock comments
- `<leader>cm` - Generate Laravel migration
- `<leader>cM` - Generate Laravel model
- `<leader>cC` - Generate Laravel controller

### Laravel Commands
- `<leader>la` - Run artisan command
- `<leader>lt` - Run PHPUnit tests
- `<leader>lm` - Run migrations
- `<leader>lr` - List routes

### File Navigation
- `<leader>ff` - Find files
- `<leader>fg` - Live grep search
- `<leader>fb` - Find buffers

### LSP Features
- `gd` - Go to definition
- `K` - Show hover information
- `<leader>ca` - Code actions
- `<leader>rn` - Rename symbol

## Chat Window Controls

When in the Copilot Chat window:
- `q` - Close chat (normal mode)
- `Ctrl+c` - Close chat (insert mode)
- `Enter` - Submit prompt (normal mode)
- `Ctrl+m` - Submit prompt (insert mode)
- `Ctrl+r` - Reset chat history
- `Ctrl+y` - Accept diff
- `gd` - Toggle diff mode
- `gs` - Toggle sticky mode

## Laravel Development Features

### File Type Support
- PHP syntax highlighting and LSP support
- Blade template support
- CSS/SCSS support
- JavaScript support
- JSON and YAML support

### Intelligent Prompts
The configuration includes Laravel-specific prompts for common development tasks:
- Creating migrations, models, and controllers
- Writing PHPUnit tests
- Optimizing Laravel code
- Adding proper DocBlock comments

### LSP Configuration
Automatic setup for:
- **Intelephense** - PHP language server
- **HTML** - HTML support
- **CSS** - CSS support
- **TypeScript/JavaScript** - JS support

## Troubleshooting

### Plugin Installation Issues
If plugins fail to install, manually trigger installation:
```vim
:Lazy sync
```

### Copilot Authentication Issues
If Copilot authentication fails:
```vim
:Copilot auth
```

### LSP Not Working
Install language servers manually:
```vim
:Mason
```

### Chat Window Issues
Reset chat configuration:
```vim
:CopilotChatReset
```

## Customization

To customize the configuration:

1. Edit the `init.lua` file
2. Modify keybindings in the keymap sections
3. Add new prompts in the `prompts` configuration
4. Adjust window layouts in the `window` configuration

## Updates

To update plugins:
```vim
:Lazy update
```

To update language servers:
```vim
:Mason
```

## Support

For issues specific to this configuration, check:
- Plugin documentation: `:help CopilotChat`
- GitHub Copilot status: `:Copilot status`
- LSP status: `:LspInfo`

## Plugin Sources

- [GitHub Copilot](https://github.com/github/copilot.vim)
- [CopilotChat](https://github.com/CopilotC-Nvim/CopilotChat.nvim)
- [Lazy.nvim](https://github.com/folke/lazy.nvim)
- [Telescope](https://github.com/nvim-telescope/telescope.nvim)
- [Treesitter](https://github.com/nvim-treesitter/nvim-treesitter)
- [LSP Config](https://github.com/neovim/nvim-lspconfig)