### Database - Payroll

##### t_employees

- Id (pk)
- nik/no karyawan
- name
- dept_id(fk)
- dept_code
- dept_name
- id_joblabel(fk)
- joblabel (ex: storeman, programmer, storeman)
- entry_date
- resign_date ( - )
- gender
- birth_place
- birth_date
- address
- id_edu(fk)
- education
- employee_term (permanent or contract)
- email

##### t_department

- id(pk)
- dept_code(fk)
- dept_name

##### t_education

- id[pk]
- education_term (eq: SMP, SMA, D3, S1, S2, S3)

##### t_jabatan

- id(pk)
- job_label
- dept_code(fk)

##### t_salary

- id(pk)
- nik(fk)
- bankAcc
- month(eq: september )
- gross_salary
- tax
- net_salary

##### t_user

- id(pk)
- username
- password
- group_id

#### t_group_user

- id(pk)
- group_name
  (Cth: id:1 as administrator system, id:2 as payroll, id:3 as user biasa,dst)
