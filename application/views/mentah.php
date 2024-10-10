$this->load->library('email');
        $htmlContent = '<div>Anda ingin mensetting Ulang Password?</div>';
        $htmlContent .= '<p>Silakahkan klik link di bawah ini</p>';
        $htmlContent .= '<a href="'.site_url().'login/reset/'.$st.'">RESET</a>';
        
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->to($this->input->post('email'));
        $this->email->from('epticketdupan@gmail.com','Ticketing Dupan Pekalongan');
        $this->email->subject('Reset Password');
        $this->email->message($htmlContent);
        $this->email->send();
        
        
        