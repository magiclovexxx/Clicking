using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.IO;
using System.Configuration;


namespace WebSitePayment
{
    public partial class Order : System.Web.UI.Page
    {
        // Đây là trang demo tạo reques thanh toán đơn hàng gửi đến cổng VTC Pay dạng đơn giản nhất (Chỉ gửi những tham số bắt buộc, chi tiết tham khảo link:
        // http://sandbox3.vtcebank.vn/VTCDocuments/TaiLieuTichHopWebSite_V2.html#ThamSoRequest


        protected void Page_Load(object sender, EventArgs e)
        {
            if (IsPostBack) return;
            txtOrderID.Text = DateTime.Now.ToString("yyyyMMddHHmmss");
        }

        protected void Button1_Click(object sender, EventArgs e)
        {
            try
            {
                string Security_Key = ConfigurationManager.AppSettings["SecretKey"]; // Key bảo mật dùng trong chuỗi tạo chữ ký

                string amount = txtTotalAmount.Text.Trim();
                string currency = ddlCurrency.SelectedValue;
                string receiver_account = txtReceiveAccount.Text.Trim();    // Tài khoản hứng tiền của đối tác tại VTC
                string reference_number = txtOrderID.Text.Trim();           // Mã đơn hàng của đối tác, VTC và đối tác dùng đơn hàng này làm cơ sở đối soát
                string transaction_type = "sale";
                string website_id = txtWebsiteID.Text.Trim();

                string plaintext = string.Format("{0}|{1}|{2}|{3}|{4}|{5}|{6}", amount, currency, receiver_account, reference_number, transaction_type, website_id, Security_Key);
                string signature = Security.SHA256encrypt(plaintext);

                NLogLogger.LogInfo("Textsign: " + plaintext + "|signature: " + signature);

                string listparam = string.Format("website_id={0}&amount={1}&receiver_account={2}&reference_number={3}&currency={4}&signature={5}&transaction_type={6}",
                  website_id, amount, receiver_account, reference_number, currency, signature, transaction_type);

                string urlRedirect = string.Format("{0}?{1}", ddlEnvinroment.SelectedValue, listparam);

                NLogLogger.LogInfo("url request full: " + urlRedirect);

                Response.Redirect(urlRedirect, false);

            }
            catch (Exception ex)
            {
                Label1.Text = ex.ToString();
                NLogLogger.Info(ex.ToString());
            }
        }

        protected void ddlEnvinroment_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (ddlEnvinroment.SelectedItem.Text == "Sandbox")
            {
				txtReceiveAccount.Text = "0963465816";
                txtWebsiteID.Text = "5023";
            }
            else if (ddlEnvinroment.SelectedItem.Text == "Live")
            {
				txtReceiveAccount.Text = "0986699480";
                txtWebsiteID.Text = "627";
            }
        }


    }
}
