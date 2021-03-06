<?php
/*
 * This file is part of BrilliantSearch-v2.0.3.1.zip.
 *
 * (c) Antropy <info@antropy.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * Do not edit this file. Check http://www.opencart.com/index.php?route=extension/extension&filter_username=judge for updates.
 */
?><?php
class ControllerExtensionModuleBrilliantsearch extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/brilliant_search');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_brilliant_search', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['text_ajax_enable'] = $this->language->get('text_ajax_enable');
		$data['text_ajax_max_results_total'] = $this->language->get('text_ajax_max_results_total');
		$data['help_ajax_max_results_total'] = $this->language->get('help_ajax_max_results_total');
		$data['text_ajax_max_results_cats'] = $this->language->get('text_ajax_max_results_cats');
		$data['help_ajax_max_results_cats'] = $this->language->get('help_ajax_max_results_cats');
		$data['text_ajax_max_results_prods'] = $this->language->get('text_ajax_max_results_prods');
		$data['help_ajax_max_results_prods'] = $this->language->get('help_ajax_max_results_prods');
		$data['text_ajax_type_delay'] = $this->language->get('text_ajax_type_delay');
		$data['help_ajax_type_delay'] = $this->language->get('help_ajax_type_delay');
		$data['text_fuzzyness'] = $this->language->get('text_fuzzyness');
		$data['help_fuzzyness'] = $this->language->get('help_fuzzyness');
		$data['text_include_categories'] = $this->language->get('text_include_categories');
		if (isset($this->request->post['module_brilliant_search_ajax_enable'])) {
			$data['module_brilliant_search_ajax_enable'] = $this->request->post['module_brilliant_search_ajax_enable'];
		} else {
			$data['module_brilliant_search_ajax_enable'] = $this->config->get('module_brilliant_search_ajax_enable');
		}
		if (isset($this->request->post['module_brilliant_search_include_categories'])) {
			$data['module_brilliant_search_include_categories'] = $this->request->post['module_brilliant_search_include_categories'];
		} else {
			$data['module_brilliant_search_include_categories'] = $this->config->get('module_brilliant_search_include_categories');
		}
		if (isset($this->request->post['module_brilliant_search_ajax_max_results_total'])) {
			$data['module_brilliant_search_ajax_max_results_total'] = $this->request->post['module_brilliant_search_ajax_max_results_total'];
		} elseif ($this->config->get('module_brilliant_search_ajax_max_results_total')) {
			$data['module_brilliant_search_ajax_max_results_total'] = $this->config->get('module_brilliant_search_ajax_max_results_total');
		} else {
			$data['module_brilliant_search_ajax_max_results_total'] = 7;
		}
		if (isset($this->request->post['module_brilliant_search_ajax_max_results_cats'])) {
			$data['module_brilliant_search_ajax_max_results_cats'] = $this->request->post['module_brilliant_search_ajax_max_results_cats'];
		} elseif ($this->config->get('module_brilliant_search_ajax_max_results_cats')) {
			$data['module_brilliant_search_ajax_max_results_cats'] = $this->config->get('module_brilliant_search_ajax_max_results_cats');
		} else {
			$data['module_brilliant_search_ajax_max_results_cats'] = 7;
		}
		if (isset($this->request->post['module_brilliant_search_ajax_max_results_prods'])) {
			$data['module_brilliant_search_ajax_max_results_prods'] = $this->request->post['module_brilliant_search_ajax_max_results_prods'];
		} elseif ($this->config->get('module_brilliant_search_ajax_max_results_prods')) {
			$data['module_brilliant_search_ajax_max_results_prods'] = $this->config->get('module_brilliant_search_ajax_max_results_prods');
		} else {
			$data['module_brilliant_search_ajax_max_results_prods'] = 7;
		}
		if (isset($this->request->post['module_brilliant_search_ajax_type_delay'])) {
			$data['module_brilliant_search_ajax_type_delay'] = $this->request->post['module_brilliant_search_ajax_type_delay'];
		} elseif ($this->config->get('module_brilliant_search_ajax_type_delay')) {
			$data['module_brilliant_search_ajax_type_delay'] = $this->config->get('module_brilliant_search_ajax_type_delay');
		} else {
			$data['module_brilliant_search_ajax_type_delay'] = 500;
		}
		if (isset($this->request->post['module_brilliant_search_fuzzyness'])) {
			$data['module_brilliant_search_fuzzyness'] = $this->request->post['module_brilliant_search_fuzzyness'];
		} elseif ($this->config->get('module_brilliant_search_fuzzyness')) {
			$data['module_brilliant_search_fuzzyness'] = $this->config->get('module_brilliant_search_fuzzyness');
		} else {
			$data['module_brilliant_search_fuzzyness'] = 70;
		}
				if (isset($this->error['ajax_max_results_total'])) {
			$data['error_ajax_max_results_total'] = $this->error['ajax_max_results_total'];
		} else {
			$data['error_ajax_max_results_total'] = '';
		}
		if (isset($this->error['ajax_max_results_cats'])) {
			$data['error_ajax_max_results_cats'] = $this->error['ajax_max_results_cats'];
		} else {
			$data['error_ajax_max_results_cats'] = '';
		}
		if (isset($this->error['ajax_max_results_prods'])) {
			$data['error_ajax_max_results_prods'] = $this->error['ajax_max_results_prods'];
		} else {
			$data['error_ajax_max_results_prods'] = '';
		}
		if (isset($this->error['ajax_type_delay'])) {
			$data['error_ajax_type_delay'] = $this->error['ajax_type_delay'];
		} else {
			$data['error_ajax_type_delay'] = '';
		}
		if (isset($this->error['fuzzyness'])) {
			$data['error_fuzzyness'] = $this->error['fuzzyness'];
		} else {
			$data['error_fuzzyness'] = '';
		}

		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/brilliant_search', 'user_token=' . $this->session->data['user_token'], 'SSL')
		);

		$data['action'] = $this->url->link('extension/module/brilliant_search', 'user_token=' . $this->session->data['user_token'], 'SSL');

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_brilliant_search_status'])) {
			$data['module_brilliant_search_status'] = $this->request->post['module_brilliant_search_status'];
		} else {
			$data['module_brilliant_search_status'] = $this->config->get('module_brilliant_search_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/brilliant_search', $data));
	}


	public function install() {
		$this->load->model('extension/module/brilliant_search');
		$this->model_extension_module_brilliant_search->install();
	}
	public function uninstall() {
		$this->load->model('extension/module/brilliant_search');
		$this->model_extension_module_brilliant_search->uninstall();
	}
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/brilliant_search')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


		if (intval($this->request->post['module_brilliant_search_ajax_max_results_total']) < 1) {
			$this->error['ajax_max_results_total'] = $this->language->get('error_ajax_max_results_total');
		}
		if (intval($this->request->post['module_brilliant_search_ajax_max_results_cats']) < 1) {
			$this->error['ajax_max_results_cats'] = $this->language->get('error_ajax_max_results_cats');
		}
		if (intval($this->request->post['module_brilliant_search_ajax_max_results_prods']) < 1) {
			$this->error['ajax_max_results_prods'] = $this->language->get('error_ajax_max_results_prods');
		}
		if (intval($this->request->post['module_brilliant_search_ajax_type_delay']) < 1) {
			$this->error['ajax_type_delay'] = $this->language->get('error_ajax_type_delay');
		}
		$intVal = intval($this->request->post['module_brilliant_search_fuzzyness']);
		if ($intVal >= 100 || $intVal <= 0) {
			$this->error['search_fuzzyness'] = $this->language->get('error_search_fuzzyness');
		}
		return !$this->error;
	}
}
