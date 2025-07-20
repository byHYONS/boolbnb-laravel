" Traditional .vimrc/.nvimrc configuration for GitHub Copilot Chat
" This file can be sourced from your existing init.vim or .vimrc

" Basic settings
set number
set relativenumber
set expandtab
set shiftwidth=4
set tabstop=4
set smartindent
set nowrap
set ignorecase
set smartcase
set termguicolors

" Set leader key
let mapleader = " "

" Auto-install vim-plug if not installed
if empty(glob('~/.local/share/nvim/site/autoload/plug.vim'))
  silent !curl -fLo ~/.local/share/nvim/site/autoload/plug.vim --create-dirs \
    https://raw.githubusercontent.com/junegunn/vim-plug/master/plug.vim
  autocmd VimEnter * PlugInstall --sync | source $MYVIMRC
endif

" Plugin management with vim-plug
call plug#begin()

" GitHub Copilot
Plug 'github/copilot.vim'

" Note: CopilotChat requires Neovim and Lua configuration
" For vim-plug users, consider using the Lua init.lua instead

call plug#end()

" Copilot settings
let g:copilot_filetypes = {'*': v:true}

" Basic keymaps
nnoremap <leader>w :w<CR>
nnoremap <leader>q :q<CR>
nnoremap <leader>x :x<CR>

" Laravel specific keymaps
nnoremap <leader>la :!php artisan 
nnoremap <leader>lt :!php artisan test<CR>
nnoremap <leader>lm :!php artisan migrate<CR>
nnoremap <leader>lr :!php artisan route:list<CR>

" Note: For full Copilot Chat functionality, use the init.lua configuration
" This .nvimrc provides basic Copilot support only

echo "Basic Nvim setup with GitHub Copilot ready!"
echo "For Copilot Chat, please use the init.lua configuration"