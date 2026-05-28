# Deploy no Vercel - Cadastro Games

## Estrutura de Pastas

```
cadastro_games/
├── api/                 # Todas as funções PHP aqui
│   ├── index.php       # Login
│   ├── menu.php        # Menu principal
│   ├── jogos.php       # Cadastro de jogos
│   ├── acao.php        # Cadastro de ações
│   ├── gestao.php      # Gestão/Relatório
│   ├── editar.php      # Editar jogo
│   └── excluir.php     # Excluir jogo
├── css/                # Estilos
├── img/                # Imagens
├── js/                 # Scripts
├── vercel.json         # Configuração Vercel
└── public/             # Pasta para arquivos estáticos
```

## Passos para Deploy

1. **Instale o Vercel CLI** (se não tiver):
   ```bash
   npm install -g vercel
   ```

2. **Configure as variáveis de ambiente**:
   - Vá para seu projeto no painel Vercel
   - Vá em "Settings" > "Environment Variables"
   - Adicione suas credenciais de banco de dados se necessário

3. **Deploy**:
   ```bash
   vercel
   ```

## Observações Importantes

⚠️ **Banco de Dados**: O Vercel é uma plataforma serverless. As conexões diretas com `localhost` não funcionarão. Você precisa:

- Migrar seu banco de dados MySQL para a nuvem (PlanetScale, AWS RDS, etc.)
- Ou usar uma plataforma que suporte PHP tradicional melhor (Heroku, Railway, Render)

### Opção 1: Usar PlanetScale (Recomendado para MySQL)

```bash
npm install -g planetscale/cli@latest
pscale auth login
```

Depois atualizar as credenciais no código PHP.

### Opção 2: Alternativas ao Vercel

Se preferir, pode usar:
- **Railway.app** - Suporta PHP e MySQL nativamente
- **Render.com** - Suporta PHP e PostgreSQL
- **Heroku** (parado) ou alternativas como Glitch, Fly.io

## Estrutura de URLs após Deploy

- Login: `https://seu-projeto.vercel.app/`
- Menu: `https://seu-projeto.vercel.app/menu.php`
- Jogos: `https://seu-projeto.vercel.app/jogos.php`
- Ação: `https://seu-projeto.vercel.app/acao.php`
- Gestão: `https://seu-projeto.vercel.app/gestao.php`

