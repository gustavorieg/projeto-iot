# 📊 Dashboard de Monitoramento de Temperatura com MQTT

Este projeto é uma **dashboard web responsiva** desenvolvida para leitura e visualização de dados de temperatura transmitidos via **protocolo MQTT**, conforme especificações de trabalho da disciplina.

---

## 🧾 Descrição do Trabalho

A partir do código base fornecido em sala de aula, o objetivo é desenvolver uma **dashboard moderna** que atenda aos seguintes requisitos:

- 📌 **Exibir a última temperatura lida em destaque.**
- 📈 **Exibir um gráfico com as temperaturas das últimas 12 horas.**
- 💬 **Receber mensagens MQTT com o seguinte formato JSON:**

```json
{
  "sensor": "temperatura",
  "valor": 21
}
```

## ⚙️ Tecnologias Utilizadas

 🧠 **MQTT** – Para comunicação com os sensores.
- 🌐 **HTML5, CSS3, JavaScript**
- 🎨 **Bootstrap 5.3** – Para design responsivo e moderno.
- 📊 **Chart.js** – Para exibição do gráfico de temperatura.
- 💡 **jQuery** – Para manipulação DOM e requisições AJAX.
- 🔥 **Laravel** – Framework PHP utilizado no backend para consumir MQTT e servir dados à dashboard.

---

## 🖼️ Funcionalidades

- ✅ Leitura de mensagens MQTT em tempo real.
- ✅ Armazenamento das leituras em banco de dados (pode ser adaptado).
- ✅ Visualização clara da **última leitura**.
- ✅ Gráfico dinâmico que mostra a **evolução da temperatura nas últimas 12 horas**.
- ✅ Design responsivo para desktop, tablets e celulares.

---

## 🚀 Como executar

# Clone o repositório
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio

# Instale as dependências do Laravel
composer install

# Crie o arquivo .env baseado no .env.example
cp .env.example .env

# Gere a chave da aplicação Laravel
php artisan key:generate

# Rode as migrations do banco
php artisan migrate

# Inicie o serviço que consome as mensagens MQTT (ajuste conforme sua implementação)
php artisan mqtt:listen

# Inicie o servidor Laravel
php artisan serve

# Abra no navegador:
# [http://localhost:8000](http://127.0.0.1:8000/)

---

## 👥 Equipe

| Nome      |   Identificação     |
|-----------|---------------------|
| Aluno 1   | Gustavo Rieg        |
| Aluno 2   | Gustavo Fantoni     |
| Aluno 3   | Arthur Estevan      |
| Aluno 4   | Cássio Venâncio     |
| Aluno 5   | Tobias Fermiano     |

---
