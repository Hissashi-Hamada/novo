<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CRUD Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="p-4">
  <div class="container">
    <h2 class="mb-3">Produtos</h2>
    <div class="mb-2">
      <button class="btn btn-primary" id="btnNew">Novo produto</button>
    </div>

    <table class="table table-bordered" id="productsTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Preço</th>
          <th>Estoque</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- Modal (Create/Edit) -->
  <div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog">
      <form id="productForm" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">Novo produto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="productId" />
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input id="name" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Preço</label>
            <input id="price" type="number" step="0.01" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Estoque</label>
            <input id="stock" type="number" class="form-control" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea id="description" class="form-control" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" id="saveBtn">Salvar</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const apiBase = '/api/products'; // ajuste se necessário
    const tableBody = document.querySelector('#productsTable tbody');
    const modalEl = document.getElementById('productModal');
    const bsModal = new bootstrap.Modal(modalEl);
    const form = document.getElementById('productForm');

    document.getElementById('btnNew').addEventListener('click', () => openModal());
    form.addEventListener('submit', saveProduct);

    async function fetchProducts() {
      try {
        const res = await fetch(apiBase);
        const data = await res.json();
        renderTable(data);
      } catch (err) {
        console.error(err);
        alert('Erro ao buscar produtos');
      }
    }

    function renderTable(products) {
      tableBody.innerHTML = '';
      for (const p of products) {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${p.id}</td>
          <td>${escapeHtml(p.name)}</td>
          <td>R$ ${Number(p.price).toFixed(2)}</td>
          <td>${p.stock}</td>
          <td>
            <button class="btn btn-sm btn-info btn-edit" data-id="${p.id}">Editar</button>
            <button class="btn btn-sm btn-danger btn-delete" data-id="${p.id}">Excluir</button>
          </td>
        `;
        tableBody.appendChild(tr);
      }
      document.querySelectorAll('.btn-edit').forEach(b => b.addEventListener('click', e => openModal(e.target.dataset.id)));
      document.querySelectorAll('.btn-delete').forEach(b => b.addEventListener('click', e => deleteProduct(e.target.dataset.id)));
    }

    function escapeHtml(text){ return text ? text.replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]) : ''; }

    async function openModal(id = null) {
      document.getElementById('productId').value = '';
      document.getElementById('name').value = '';
      document.getElementById('price').value = '';
      document.getElementById('stock').value = '';
      document.getElementById('description').value = '';
      document.getElementById('modalTitle').textContent = id ? 'Editar produto' : 'Novo produto';

      if (id) {
        try {
          const res = await fetch(`${apiBase}/${id}`);
          if (!res.ok) throw new Error('Produto não encontrado');
          const p = await res.json();
          document.getElementById('productId').value = p.id;
          document.getElementById('name').value = p.name;
          document.getElementById('price').value = p.price;
          document.getElementById('stock').value = p.stock;
          document.getElementById('description').value = p.description || '';
        } catch (err) {
          alert('Erro ao carregar produto');
          return;
        }
      }
      bsModal.show();
    }

    async function saveProduct(e) {
      e.preventDefault();
      const id = document.getElementById('productId').value;
      const payload = {
        name: document.getElementById('name').value.trim(),
        price: parseFloat(document.getElementById('price').value) || 0,
        stock: parseInt(document.getElementById('stock').value) || 0,
        description: document.getElementById('description').value.trim(),
      };
      try {
        const res = await fetch(id ? `${apiBase}/${id}` : apiBase, {
          method: id ? 'PUT' : 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });
        if (!res.ok) throw new Error('Erro no servidor');
        bsModal.hide();
        await fetchProducts();
      } catch (err) {
        console.error(err);
        alert('Erro ao salvar produto');
      }
    }

    async function deleteProduct(id) {
      if (!confirm('Confirmar exclusão?')) return;
      try {
        const res = await fetch(`${apiBase}/${id}`, { method: 'DELETE' });
        if (!res.ok) throw new Error('Falha ao excluir');
        await fetchProducts();
      } catch (err) {
        console.error(err);
        alert('Erro ao excluir produto');
      }
    }

    // carrega lista inicial
    fetchProducts();
  </script>
</body>
</html>
