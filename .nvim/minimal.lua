-- Minimal Neovim configuration with GitHub Copilot Chat
-- This is a simplified version for quick setup

-- Basic settings
vim.opt.number = true
vim.opt.expandtab = true
vim.opt.shiftwidth = 4
vim.opt.tabstop = 4
vim.opt.termguicolors = true

-- Set leader key
vim.g.mapleader = " "

-- Bootstrap lazy.nvim
local lazypath = vim.fn.stdpath("data") .. "/lazy/lazy.nvim"
if not vim.loop.fs_stat(lazypath) then
  vim.fn.system({
    "git", "clone", "--filter=blob:none",
    "https://github.com/folke/lazy.nvim.git",
    "--branch=stable", lazypath,
  })
end
vim.opt.rtp:prepend(lazypath)

-- Minimal plugin setup
require("lazy").setup({
  -- GitHub Copilot
  {
    "github/copilot.vim",
    config = function()
      vim.g.copilot_filetypes = { ["*"] = true }
    end,
  },
  
  -- GitHub Copilot Chat
  {
    "CopilotC-Nvim/CopilotChat.nvim",
    branch = "canary",
    dependencies = {
      { "github/copilot.vim" },
      { "nvim-lua/plenary.nvim" },
    },
    config = function()
      require("CopilotChat").setup({
        window = { layout = 'vertical', width = 0.5 },
        prompts = {
          Explain = { prompt = "Explain this code", mapping = "<leader>ce" },
          Tests = { prompt = "Write PHPUnit tests for this Laravel code", mapping = "<leader>ct" },
          Fix = { prompt = "Fix this Laravel code", mapping = "<leader>cf" },
          Optimize = { prompt = "Optimize this Laravel code", mapping = "<leader>co" },
        },
      })
      
      -- Key mappings
      vim.keymap.set('n', '<leader>cc', '<cmd>CopilotChat<CR>')
      vim.keymap.set('v', '<leader>cc', '<cmd>CopilotChatVisual<CR>')
      vim.keymap.set('v', '<leader>ce', '<cmd>CopilotChatExplain<CR>')
      vim.keymap.set('v', '<leader>cf', '<cmd>CopilotChatFix<CR>')
      vim.keymap.set('v', '<leader>ct', '<cmd>CopilotChatTests<CR>')
      vim.keymap.set('v', '<leader>co', '<cmd>CopilotChatOptimize<CR>')
    end,
  },
})

-- Basic keymaps
vim.keymap.set('n', '<leader>w', '<cmd>w<CR>')
vim.keymap.set('n', '<leader>q', '<cmd>q<CR>')

print("Minimal Nvim setup with Copilot Chat ready!")