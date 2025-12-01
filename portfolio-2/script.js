document.querySelector('.menu-btn').addEventListener('click', () => {
  document.querySelector('.nav-links').classList.toggle('active');
});

const skills = ['HTML5', 'CSS3', 'JavaScript', 'PHP', 'Java'];
const list = document.getElementById('skills-list');
skills.forEach(skill => {
  const li = document.createElement('li');
  li.textContent = skill;
  list.appendChild(li);
});