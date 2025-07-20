-- Neovim configuration for Laravel development with GitHub Copilot Chat
-- Place this in your ~/.config/nvim/init.lua or use as a project-specific config

-- Basic settings
vim.opt.number = true
vim.opt.relativenumber = true
vim.opt.expandtab = true
vim.opt.shiftwidth = 4
vim.opt.tabstop = 4
vim.opt.smartindent = true
vim.opt.wrap = false
vim.opt.ignorecase = true
vim.opt.smartcase = true
vim.opt.termguicolors = true

-- Laravel specific file type detection
vim.filetype.add({
  extension = {
    blade = "blade",
  },
  pattern = {
    [".*%.blade%.php"] = "blade",
  },
})

-- Bootstrap lazy.nvim plugin manager
local lazypath = vim.fn.stdpath("data") .. "/lazy/lazy.nvim"
if not vim.loop.fs_stat(lazypath) then
  vim.fn.system({
    "git",
    "clone",
    "--filter=blob:none",
    "https://github.com/folke/lazy.nvim.git",
    "--branch=stable", -- latest stable release
    lazypath,
  })
end
vim.opt.rtp:prepend(lazypath)

-- Plugin specifications
local plugins = {
  -- GitHub Copilot
  {
    "github/copilot.vim",
    config = function()
      -- Enable Copilot for all file types
      vim.g.copilot_filetypes = {
        ["*"] = true,
      }
      
      -- Copilot keymaps
      vim.keymap.set('i', '<C-j>', '<Plug>(copilot-next)')
      vim.keymap.set('i', '<C-k>', '<Plug>(copilot-previous)')
      vim.keymap.set('i', '<C-l>', '<Plug>(copilot-accept-word)')
      vim.keymap.set('i', '<C-h>', '<Plug>(copilot-dismiss)')
    end,
  },
  
  -- GitHub Copilot Chat
  {
    "CopilotC-Nvim/CopilotChat.nvim",
    branch = "canary",
    dependencies = {
      { "github/copilot.vim" }, -- or github/copilot.vim
      { "nvim-lua/plenary.nvim" }, -- for curl, log wrapper
    },
    config = function()
      require("CopilotChat").setup({
        debug = false, -- Enable debugging
        
        -- Chat window configuration
        window = {
          layout = 'vertical', -- 'vertical', 'horizontal', 'float'
          width = 0.5, -- fractional width of parent, or absolute width in columns when > 1
          height = 0.5, -- fractional height of parent, or absolute height in rows when > 1
        },
        
        -- Chat mappings
        mappings = {
          complete = {
            detail = "Use @copilot or \\<C-a> to trigger Copilot completion",
            insert = "<C-a>",
          },
          close = {
            detail = "Close chat window",
            normal = "q",
            insert = "<C-c>",
          },
          reset = {
            detail = "Reset chat history",
            normal = "<C-r>",
          },
          submit_prompt = {
            detail = "Submit prompt to Copilot",
            normal = "<CR>",
            insert = "<C-m>",
          },
          accept_diff = {
            detail = "Accept diff",
            normal = "<C-y>",
          },
          toggle_sticky = {
            detail = "Toggle sticky mode for chat input",
            normal = "gs",
          },
          toggle_diff = {
            detail = "Toggle diff mode",
            normal = "gd",
          },
        },
        
        -- Prompt presets for Laravel development
        prompts = {
          Explain = {
            prompt = "Please explain how the following code works.",
            mapping = "<leader>ce",
            description = "Copilot explain code",
          },
          Tests = {
            prompt = "Please write PHPUnit tests for the following Laravel code.",
            mapping = "<leader>ct",
            description = "Generate PHPUnit tests",
          },
          Fix = {
            prompt = "Please fix the following Laravel code.",
            mapping = "<leader>cf",
            description = "Fix Laravel code issues",
          },
          Optimize = {
            prompt = "Please optimize the following Laravel code for better performance.",
            mapping = "<leader>co",
            description = "Optimize Laravel code",
          },
          DocBlock = {
            prompt = "Please add proper Laravel/PHP DocBlock comments to the following code.",
            mapping = "<leader>cd",
            description = "Add DocBlock comments",
          },
          Migration = {
            prompt = "Please create a Laravel migration for the following requirements.",
            mapping = "<leader>cm",
            description = "Generate Laravel migration",
          },
          Model = {
            prompt = "Please create a Laravel Eloquent model for the following table structure.",
            mapping = "<leader>cM",
            description = "Generate Laravel model",
          },
          Controller = {
            prompt = "Please create a Laravel controller with CRUD operations for the following model.",
            mapping = "<leader>cC",
            description = "Generate Laravel controller",
          },
        },
        
        -- Auto-insert mode configuration
        auto_insert_mode = true,
        
        -- Show help message
        show_help = true,
        
        -- Question header
        question_header = "## User ",
        answer_header = "## Copilot ",
        error_header = "## Error ",
        
        -- Separator
        separator = "---",
      })
      
      -- Copilot Chat keymaps
      vim.keymap.set('n', '<leader>cc', '<cmd>CopilotChat<CR>', { desc = "Open Copilot Chat" })
      vim.keymap.set('n', '<leader>ccq', '<cmd>CopilotChatClose<CR>', { desc = "Close Copilot Chat" })
      vim.keymap.set('n', '<leader>ccr', '<cmd>CopilotChatReset<CR>', { desc = "Reset Copilot Chat" })
      vim.keymap.set('n', '<leader>cct', '<cmd>CopilotChatToggle<CR>', { desc = "Toggle Copilot Chat" })
      
      -- Visual mode mappings for selected code
      vim.keymap.set('v', '<leader>cc', '<cmd>CopilotChatVisual<CR>', { desc = "Chat about selected code" })
      vim.keymap.set('v', '<leader>ce', '<cmd>CopilotChatExplain<CR>', { desc = "Explain selected code" })
      vim.keymap.set('v', '<leader>cf', '<cmd>CopilotChatFix<CR>', { desc = "Fix selected code" })
      vim.keymap.set('v', '<leader>co', '<cmd>CopilotChatOptimize<CR>', { desc = "Optimize selected code" })
      vim.keymap.set('v', '<leader>ct', '<cmd>CopilotChatTests<CR>', { desc = "Generate tests for selected code" })
    end,
  },

  -- Additional useful plugins for Laravel development
  
  -- Telescope for fuzzy finding
  {
    'nvim-telescope/telescope.nvim',
    dependencies = { 'nvim-lua/plenary.nvim' },
    config = function()
      require('telescope').setup{}
      vim.keymap.set('n', '<leader>ff', '<cmd>Telescope find_files<cr>', { desc = "Find files" })
      vim.keymap.set('n', '<leader>fg', '<cmd>Telescope live_grep<cr>', { desc = "Live grep" })
      vim.keymap.set('n', '<leader>fb', '<cmd>Telescope buffers<cr>', { desc = "Find buffers" })
    end
  },
  
  -- Tree-sitter for better syntax highlighting
  {
    "nvim-treesitter/nvim-treesitter",
    build = ":TSUpdate",
    config = function()
      require("nvim-treesitter.configs").setup({
        ensure_installed = {
          "php",
          "html",
          "css",
          "scss",
          "javascript",
          "blade",
          "sql",
          "json",
          "yaml",
        },
        highlight = { enable = true },
        indent = { enable = true },
      })
    end,
  },
  
  -- LSP configuration
  {
    "neovim/nvim-lspconfig",
    dependencies = {
      "williamboman/mason.nvim",
      "williamboman/mason-lspconfig.nvim",
    },
    config = function()
      require("mason").setup()
      require("mason-lspconfig").setup({
        ensure_installed = {
          "intelephense", -- PHP LSP
          "html",
          "cssls",
          "ts_ls",
        },
      })
      
      local lspconfig = require("lspconfig")
      
      -- PHP (Intelephense)
      lspconfig.intelephense.setup({
        settings = {
          intelephense = {
            files = {
              maxSize = 1000000,
            },
          },
        },
      })
      
      -- HTML
      lspconfig.html.setup({})
      
      -- CSS
      lspconfig.cssls.setup({})
      
      -- TypeScript/JavaScript
      lspconfig.ts_ls.setup({})
      
      -- LSP keymaps
      vim.keymap.set('n', 'gd', vim.lsp.buf.definition, { desc = "Go to definition" })
      vim.keymap.set('n', 'K', vim.lsp.buf.hover, { desc = "Hover" })
      vim.keymap.set('n', '<leader>ca', vim.lsp.buf.code_action, { desc = "Code action" })
      vim.keymap.set('n', '<leader>rn', vim.lsp.buf.rename, { desc = "Rename" })
    end,
  },
}

-- Setup lazy.nvim
require("lazy").setup(plugins, {
  -- Configure lazy.nvim options
  checker = { enabled = true }, -- automatically check for plugin updates
})

-- Set leader key
vim.g.mapleader = " "

-- General keymaps
vim.keymap.set('n', '<leader>w', '<cmd>w<CR>', { desc = "Save file" })
vim.keymap.set('n', '<leader>q', '<cmd>q<CR>', { desc = "Quit" })
vim.keymap.set('n', '<leader>x', '<cmd>x<CR>', { desc = "Save and quit" })

-- Laravel specific keymaps
vim.keymap.set('n', '<leader>la', '<cmd>!php artisan ', { desc = "Run artisan command" })
vim.keymap.set('n', '<leader>lt', '<cmd>!php artisan test<CR>', { desc = "Run PHPUnit tests" })
vim.keymap.set('n', '<leader>lm', '<cmd>!php artisan migrate<CR>', { desc = "Run migrations" })
vim.keymap.set('n', '<leader>lr', '<cmd>!php artisan route:list<CR>', { desc = "List routes" })

-- Auto commands for Laravel specific settings
vim.api.nvim_create_autocmd("FileType", {
  pattern = { "php", "blade" },
  callback = function()
    vim.opt_local.commentstring = "// %s"
    vim.opt_local.shiftwidth = 4
    vim.opt_local.tabstop = 4
  end,
})

print("Nvim configured for Laravel development with GitHub Copilot Chat!")